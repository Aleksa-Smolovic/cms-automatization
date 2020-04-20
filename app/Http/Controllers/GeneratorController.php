<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use App\TableContent;
use App\ForeignKeyInstance;

class GeneratorController extends Controller
{
    //include: Class -> TableContent, Example resource folder, Admin css/js, templates
    //Tags in web and index.blade(nav), FileHandle Trait, GeneratorController, AutomatizationInputController

    //TO DO Error Handling
    //TO DO _ -> - za spaceove
    //TO DO upisati u jedan fajl? writeController   

    private $ajaxReturnData = 'returndata';

    public function insertIntoIndex($modelName, $tableName){
        $routeIndex = str_replace("_","-", $tableName);
        $item = "
        	<li class=\"nav-item\">
                <a class=\"nav-link\" href=\"{{ route('admin/$routeIndex') }}\">
                    <i class=\"fab fa-fw fa-wpforms\"></i>$modelName
                </a>
            </li>
            <!-- MARKER -->";

        $filePath = "resources/views/layouts/index.blade.php";

        $str = file_get_contents($filePath);
        $str = str_replace("<!-- MARKER -->", $item, $str);
        file_put_contents($filePath, $str);
    }

    public function insertIntoWeb($tableName){
        $controllerName = $this->capitalizeAttributes($tableName);
        $tableName = str_replace("_","-", $tableName);

        $item = "
    Route::get('/admin/" . $tableName . "', '" . $controllerName . "Controller@index')->name('admin/" . $tableName . "');
    Route::get('/admin/" . $tableName . "/deleted', '" . $controllerName . "Controller@deleted')->name('admin/" . $tableName . "/deleted');
    Route::get('/admin/" . $tableName . "/{id}', '" . $controllerName . "Controller@getOne')->name('admin/" . $tableName . "/fetch');
    Route::delete('/admin/" . $tableName . "/delete/{id}', '" . $controllerName . "Controller@destroy')->name('" . $tableName . "/delete');
    Route::post('/admin/" . $tableName . "/restore/{id}', '" . $controllerName . "Controller@restore')->name('" . $tableName . "/restore');
    Route::post('/admin/" . $tableName . "/store', '" . $controllerName . "Controller@store')->name('" . $tableName . "/store');
    Route::post('/admin/" . $tableName . "/edit', '" . $controllerName . "Controller@edit')->name('" . $tableName . "/edit');
    //->MARKER";

        $filePath = "routes/web.php";

        $str = file_get_contents($filePath);
        $str = str_replace("//->MARKER", $item, $str);
        file_put_contents($filePath, $str);
    }

    //TO DO vidjeti moze li create or replace na file ili folder?
    public function createIndexDeletedFiles($tableName){
        $tableName = strtolower($tableName);
        if (!file_exists('resources/views/admin/' . $tableName)) {
            if(!mkdir('resources/views/admin/' . $tableName, 0777, true));
        }else{
            exit($tableName);
        }

        //TO DO povuci sa interneta fajl?
        $indexContent = file_get_contents('resources/views/admin/example/index.blade.php');
        $myfile = fopen("resources/views/admin/" . $tableName . "/index.blade.php", "w") or die("Unable to open file!");
        fwrite($myfile, $indexContent);
        fclose($myfile);

        $deletedContent = file_get_contents('resources/views/admin/example/deleted.blade.php');
        $deletedFile = fopen("resources/views/admin/" . $tableName . "/deleted.blade.php", "w") or die("Unable to open file!");
        fwrite($deletedFile, $deletedContent);
        fclose($deletedFile);
    }

    public function writeModel($modelName, $tableName, $contentArray){
        $templatePath = 'templates/ModelTemplate';
        $template = file_get_contents($templatePath);
        $filePath = "app/" . $modelName . '.php';

        $dataTypeMutators = ['date', 'datetime', 'image', 'unsignedBigInteger'];
        $mutators = '';
        foreach($contentArray as $contentInstance) if(in_array($contentInstance->dataType, $dataTypeMutators))
            $mutators .= $this->createMutators($contentInstance, $modelName, $tableName);

        $markers = ['||model||', '||table||', '||mutators||'];
        $realData = [$modelName, $tableName, $mutators];
        $template =  str_replace($markers, $realData, $template);
        file_put_contents($filePath, $template);
    }

    public function writeController($modelName, $tableName, $contentArray){
        $templatePath = 'templates/ControllerTemplate';
        $template = file_get_contents($templatePath);
        $filePath = "app/Http/Controllers/" . $modelName . 'Controller.php';

        $includes = $visibleFields = $relationshipObjects = $foreignKeySelect = '';

        foreach($contentArray as $contentInstance) if($contentInstance->foreignKey){
            $foreignModelName = $contentInstance->foreignKey->modelName;
            $displayField = $contentInstance->foreignKey->displayField;
            $displayField = $displayField == 'id' ? "'id'" : "'id', '" . $displayField . "'";
            $includes .= '
            use App\\' . $foreignModelName . ';';
            $foreignKeySelect .= '
            $' . strtolower($foreignModelName) . ' = ' . $foreignModelName . '::select(' . $displayField . ')->orderBy("id", "DESC")->get();';
            $relationshipObjects .= ', "' . strtolower($foreignModelName) . '"';
        }

        foreach($contentArray as $contentInstance) if($contentInstance->isVisible)
            $visibleFields .= ", '" . $contentInstance->name . "'";
        
        $markers = ['||model||', '||table||', '||attributes||', '||foreignIncludes||', '||foreignFetch||', '||foreignObjects||'];
        $realData = [$modelName, $tableName, $visibleFields, $includes, $foreignKeySelect, $relationshipObjects];
        $template =  str_replace($markers, $realData, $template);
        file_put_contents($filePath, $template);
    }

    public function changeMigrations($modelName, $tableName, $contentArray){
        $filename = "database/migrations/*";
        foreach (glob($filename) as $filefound) {
            if(strpos($filefound, $tableName) !== false){
                $migrationFileName = $filefound;
            }
        }
        if(!isset($migrationFileName)){
            echo 'File not found ' . $tableName;
            return;
        }

        $marker = '$table->timestamps();';
        $attributesOutput = '';
        $seederData = [];

        foreach($contentArray as $contentInstance){
            $contentFieldName = $contentInstance->name;
            switch($contentInstance->dataType){
                case 'image':
                    $dataType = 'text';
                    $seederDataType = 'imageUrl($width = 640, $height = 480),';
                    break;
                case 'text':
                    $dataType = 'text';
                    $seederDataType = 'realText($maxNbChars = 200, $indexSize = 2),';
                    break;
                case 'string':
                    $dataType = 'string';
                    $seederDataType = 'sentence($nbWords = 3, $variableNbWords = true),';
                    break;
                case 'boolean':
                    $dataType = 'boolean';
                    $seederDataType = 'boolean($chanceOfGettingTrue = 50),';
                    break;
                case 'integer':
                    $dataType = 'integer';
                    $seederDataType = 'numberBetween($min = 50, $max = 450),';
                    break;
                case 'date':
                    $dataType = 'date';
                    $seederDataType = 'date($format = "d/m/Y", $max = "now"),';
                    break;
                case 'datetime':
                    $dataType = 'datetime';
                    $seederDataType = 'dateTime($max = "now", $timezone = null)->format("d/m/Y H:i:s"),';
                    break;
                case 'double':
                    $dataType = 'double';
                    $seederDataType = 'randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),';
                    break;
                case 'unsignedBigInteger':
                    $dataType = 'unsignedBigInteger';
                    $seederDataType = 'numberBetween($min = 1, $max = 10),';
                    break;    
                default:
                    //TO DO bolje rjesenje
                    $dataType = 'unsignedBigInteger';
                    $seederDataType = 'numberBetween($min = 0, $max = 10),';
                    break;
            }

            $seederData[$contentFieldName] = '
                $faker->' . $seederDataType;

            $attributesOutput .= '$table->' . $dataType . '("' . $contentFieldName . '");
            ';

            if($dataType == 'unsignedBigInteger') 
                $attributesOutput .= '$table->foreign("' .  $contentFieldName . '")->references("id")->on("' .  $contentInstance->foreignKey->tableName . '");
                    ';
        }

        $attributesOutput .= '
            $table->unsignedBigInteger("create_user_id");
            $table->unsignedBigInteger("update_user_id")->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign("create_user_id")->references("id")->on("users");
            $table->foreign("update_user_id")->references("id")->on("users");
            ';
        $str = file_get_contents($migrationFileName);
        $str = str_replace($marker, $attributesOutput, $str);
        file_put_contents($migrationFileName, $str);

        $this->changeSeeder($modelName, $seederData);
    }

    public function capitalToDashString($str){
        return strtolower(preg_replace('~(?=[A-Z])(?!\A)~', '_', $str));
    }

    public function getHtmlInputs(TableContent $contentInstance){
        $inputType = $contentInstance->inputType;
        $inputName = $contentInstance->name;
        $inputPlaceholder = $contentInstance->placeholder;
        switch($inputType){
            case 'textarea':
                return '
                    <div class="row">
                        <div class="col-12"> 
                            <div class="form-group">
                                <label class="col-form-label" for="' . $inputName . '">' . $inputPlaceholder . ' *</label>
                                <textarea class="form-control" id="' . $inputName . '" name="' . $inputName . '" placeholder="' . $inputPlaceholder . '"></textarea>
                            </div>
                        </div>
                    </div>
                    ';
                break;
            case 'date':
                return '
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label class="col-form-label" for="' . $inputName . '">' . $inputPlaceholder . ' *</label>
                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                <input name="' . $inputName . '" id="' . $inputName . '" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
                                <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                ';
                break;    
            case 'datetime':
                return '
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label class="col-form-label" for="' . $inputName . '">' . $inputPlaceholder . ' *</label>
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input id="' . $inputName . '" type="text" name="' . $inputName . '" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            ';
                break;    
            case 'file':
                if($contentInstance->dataType == 'image'){
                    $imageHolder = '
                <div class="row">
                    <div class="col-12">
                        <img width="100%" style="max-height:25%" id="' . $inputName . 'Holder"/>
                    </div>
                </div>
                ';
                }
                return $imageHolder . '
                    <div class="row">
						<div class="col-12"> 
							<div class="form-group">
								<label class="col-form-label" for="' . $inputName . '">' . $inputPlaceholder . ' *</label>
								<input type="file" id="' . $inputName . '" class="form-control" name="' . $inputName . '"/>
							</div>
						</div>
                    </div>
                    ';
                break;
            case 'foreign_key':
                $modelName = $contentInstance->foreignKey->modelName;
                $displayField = $contentInstance->foreignKey->displayField;
                return '
                    <div class="row">
                        <div class="col-12"> 
                            <div class="form-group">
                                <label class="col-form-label" for="' . $inputName . '">' . $inputPlaceholder . ' *</label>
                                <select class="form-control" id="' . $inputName . '" name="' . $inputName . '">
                                    <option selected disabled>Odaberite</option>
                                    @foreach($' . strtolower($modelName) . ' as $single' . $modelName . ')
                                        <option value="{{$single' . $modelName . '->id}}">{{$single' . $modelName . '->' . $displayField . '}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    ';
                break;
            default:
                return '
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label class="col-form-label" for="' . $inputName . '">' . $inputPlaceholder . ' *</label>
                            <input id="' . $inputName . '" class="form-control" type="' . $inputType . '" placeholder="' . $inputPlaceholder . '" name="' . $inputName . '">
                        </div>
                    </div>
                </div>
                ';
                break;
        }

    }

    public function getTableContent(TableContent $tableContent){
        switch($tableContent->dataType){
            case 'image':
                return '<td class="text-center">
                            <img class="rounded" src="{{ $object->' . $tableContent->name . '}}" width="60">
                        </td>';
                break;
            default:
                return '<td class="text-center">{{ $object->' . $tableContent->name . ' }}</td>
                ';
                break;
        }
    }

    public function writeIndexBlade($tableName, $contentArray){
        $filePath = "resources/views/admin/" . $tableName . "/index.blade.php";
        $indexContent = file_get_contents($filePath);

        $tableHeaders = $tableContent = $editBtnData = $modalOpenValue = $htmlInputs = $modalCloseValue = '';

        $editBtnData .=  $tableName . '/{{$object->id}}';

        foreach($contentArray as $column){
            if ($column->isVisible){
                $tableHeaders .= '<th class="text-center">' . $column->placeholder . '</th>
                ';
                $tableContent .= $this->getTableContent($column);
            }
            if($column->inputType == 'file' && $column->dataType == 'image'){
                $modalOpenValue .= 	"$('#" . $column->name . "Holder').attr({ 'src': " . $this->ajaxReturnData .".". $column->name . " });
                ";
                $modalCloseValue = 'var $image = $("#' . $column->name . 'Holder");
            $("#' . $column->name . 'Holder").removeAttr("src").replaceWith($image.clone());';
            }else{
                $modalOpenValue .= 	"$('#" . $column->name . "').val(" . $this->ajaxReturnData .".". $column->name . " );
                ";
            }
            $htmlInputs .= $this->getHtmlInputs($column);
        }

        $markers = ['<!-- Marker Table Heading -->', '<!-- Marker Table Content -->', 'data-route-marker',
        'tableNameMarker', '//OpenModalMarker', '//CloseModalMarker', '<!-- InputsMarker -->'];
        $realData = [$tableHeaders, $tableContent, $editBtnData, $tableName, $modalOpenValue, $modalCloseValue, $htmlInputs];
        $indexContent = str_replace($markers, $realData, $indexContent);
        file_put_contents($filePath, $indexContent);

        $filePath = "resources/views/admin/" . $tableName . "/deleted.blade.php";
        $deletedContent = file_get_contents($filePath);
        $markers = ['<!-- Marker Table Heading -->', '<!-- Marker Table Content -->', 'tableNameMarker',];
        $realData = [$tableHeaders, $tableContent, $deletedContent];
        $deletedContent = str_replace($markers, $realData, $deletedContent);
        file_put_contents($filePath, $deletedContent);
    }

    public function declareValidation(TableContent $tableContentInsance){

        switch($tableContentInsance->inputType){
            case 'textarea':
                return "
            '$tableContentInsance->name' => 'required|max:10000',";
                break;
            case 'date':
                return "
            '$tableContentInsance->name' => 'required|date_format:d/m/Y',";
                break;  
            case 'datetime':
                return "
            '$tableContentInsance->name' => 'required|date_format:d/m/Y H:i:s',";
                break;    
            case 'file':
                if($tableContentInsance->dataType == 'image'){
                    return "
            '$tableContentInsance->name' => 'required|max:5000|mimes:jpeg,png,jpg,gif,svg',";
                }
                return "
            '$tableContentInsance->name' => 'required|max:5000|mimes:pdf,docx',";
                break;
            case 'foreign_key':
                return "
            '$tableContentInsance->name' => 'required',";
                break;
            default:
                return "
            '$tableContentInsance->name' => 'required|max:191',";
                break;
        }

    }

    public function validationAlerts(TableContent $contentInstance){
        $inputName = $contentInstance->name;
        $inputPlaceholder = $contentInstance->placeholder;
        switch($contentInstance->inputType){
            case 'textarea':
                return "
            '$inputName.required' => 'Morate unijeti " . strtolower($inputPlaceholder) . "!',
            '$inputName.max' => '$inputPlaceholder može sadržati maksimum 10000 karakera!',";
                break;
            case 'date':
                return "
            '$inputName.required' => 'Morate unijeti " . strtolower($inputPlaceholder) . "!',
            '$inputName.date_format' => '$inputPlaceholder mora biti dormata d/m/y!',";
                break;
            case 'datetime':
                return "
            '$inputName.required' => 'Morate unijeti " . strtolower($inputPlaceholder) . "!',
            '$inputName.date_format' => '$inputPlaceholder mora biti dormata d/m/y h:i:s!',";
                break;    
            case 'file':
                if($contentInstance->dataType == 'image'){
                    return "
            '$inputName.required' => 'Morate unijeti " . strtolower($inputPlaceholder) . "!',
            '$inputName.max' => 'Maksimalna veličina " . strtolower($inputPlaceholder) . " je 5mb!',
            '$inputName.mimes' => '$inputPlaceholder može biti formata: jpeg,png,jpg,gif,svg!',";
                }
                return "
            '$inputName.required' => 'Morate unijeti " . strtolower($inputPlaceholder) . "!',
            '$inputName.max' => 'Maksimalna veličina " . strtolower($inputPlaceholder) . " je 5mb!',
            '$inputName.mimes' => '$inputPlaceholder može biti formata: pdf,docx!',";
                break;
            case 'foreign_key':
                return "
            '$inputName.required' => 'Morate unijeti " . strtolower($inputPlaceholder) . "!',";
                break;    
            default:
                return "
            '$inputName.required'=> 'Morate unijeti " . strtolower($inputPlaceholder) . "!',
            '$inputName.max'=> '$inputPlaceholder može sadržati najviše 191 karaktera!',";
                break;
        }

    }

    public function createMutators(TableContent $tableContentInsance, $modelName, $tableName){
        $fieldName = $tableContentInsance->name;
        switch($tableContentInsance->dataType){
            case 'date':
                return '
            public function get' . $this->capitalizeAttributes($fieldName) . 'Attribute($value){
                return Carbon::parse($value)->format("d/m/Y");
            }
            
            public function set' . $this->capitalizeAttributes($fieldName)  . 'Attribute($value)
            {
                $this->attributes["' . $fieldName . '"] = Carbon::createFromFormat("d/m/Y", $value);
            }';
                break;
            case 'datetime':
                return '
            public function get' . $this->capitalizeAttributes($fieldName) . 'Attribute($value){
                return Carbon::parse($value)->format("d/m/Y H:i:s");
            }
            
            public function set' . $this->capitalizeAttributes($fieldName)  . 'Attribute($value)
            {
                $this->attributes["' . $fieldName . '"] = Carbon::createFromFormat("d/m/Y H:i:s", $value);
            }';
                break;
            case 'image':
                    return '
            public function get' . $this->capitalizeAttributes($fieldName) . 'Attribute($value){
                return strpos($value, "http") === false ? asset($value) : $value;
            } 
            
            public function set' . $this->capitalizeAttributes($fieldName)  . 'Attribute($value)
            {
                if($value)
                    $this->attributes["' . $fieldName . '"] = is_string($value) ? $value : ' . $modelName . '::storeFile($value, "' . $tableName . '");
            }';
                break;
            case 'unsignedBigInteger':
                    return '
            public function ' . strtolower($tableContentInsance->foreignKey->modelName) . '(){
                return $this->belongsTo(' . $tableContentInsance->foreignKey->modelName . '::class);
            }';
                break;
        }
    }

    public function capitalizeAttributes($str) {
        $frags = explode('_', $str);
        for ($i = 0; $i < count($frags); $i++) {
          $frags[$i] = strtoupper(substr($frags[$i], 0, 1)) . substr($frags[$i], 1);;
        }
        return join('', $frags);
    }

    public function generate($table){
        $tableName = strtolower($table['table_name']);
        $modelName = $table['model_name'];
        $contentArray = $table['attributes'];

        Artisan::call('make:model ' . $modelName . ' -m');
        Artisan::call('make:controller ' . $modelName . 'Controller');
        Artisan::call('make:seeder ' . $modelName . 'Seeder');
        Artisan::call('make:request ' . $modelName . 'Request');

        $this->writeModel($modelName, $tableName, $contentArray);
        $this->createIndexDeletedFiles(str_replace("_","-", $tableName));

        $this->insertIntoIndex($modelName, $tableName);
        $this->insertIntoWeb($tableName);
        $this->writeController($modelName, $tableName, $contentArray);

        $this->changeMigrations($modelName, $tableName, $contentArray);
        $this->writeIndexBlade(str_replace("_","-", $tableName), $contentArray);
        $this->writeFormRequest($modelName, $tableName, $contentArray);
    }

    public function changeSeeder($modelName, $seederData){
        $folderPath = 'database/seeds/';
        $seederFileName =  $folderPath . $modelName . 'Seeder.php';
        $str = file_get_contents($seederFileName);
        if($str === false || empty($str)) 
            exit($seederFileName);
        $seedOutput =
        '$faker = Faker\Factory::create();
            for($i = 0; $i < 20; $i++) {
                App\\' . $modelName . '::create([
                ';
        foreach ($seederData as $key => $value) {
            $seedOutput .= '
                "' . $key . '" => ' . $value;
        }
        $seedOutput .= '
            "create_user_id" => 1, //$faker->numberBetween($min = 1, $max = 10),
            "created_at" => $faker->dateTime($max = \'now\', $timezone = null)
            ]);
        }';
        $marker = '//';
        $str = str_replace($marker, $seedOutput, $str);
        file_put_contents($seederFileName, $str);

        $dbSeederFile =  $folderPath . 'DatabaseSeeder.php';
        $dbSeederText = file_get_contents($dbSeederFile);
        $seederInitialization = '$this->call(' . $modelName . 'Seeder::class);
            ';
        $initializationPos = strpos($dbSeederText, '}');
        $dbSeederOutput = substr_replace($dbSeederText, $seederInitialization, $initializationPos - 1, 0);
        file_put_contents($dbSeederFile, $dbSeederOutput);
    }

    public function writeFormRequest($modelName, $tableName, $contentArray){
        $templatePath = 'templates/FormRequestTemplate';
        $template = file_get_contents($templatePath);

        Artisan::call('make:request ' . $modelName . 'Request');
        $filePath = "app/Http/Requests/" . $this->capitalizeAttributes($modelName) . 'Request.php';
        $fileContent = file_get_contents($filePath);
        $tableName = str_replace("_","-", $tableName);

        $rules = $messages = $additionalHandling = $additionalActionsMerge = '';

        foreach($contentArray as $contentInstance){
            $rules .= $this->declareValidation($contentInstance);
            $messages .= $this->validationAlerts($contentInstance);
            // if($contentInstance->inputType == 'file'){
            //     $attributeName = $contentInstance->name;
            //     $additionalHandling .= 'if($this->' . $attributeName . ')
            //     $' . $attributeName  . ' = ' . $modelName . '::storeFile($data["' . $attributeName . '"], "' . $tableName . '");';   
            //     $additionalActionsMerge = "'" . $attributeName . "' => $" . $attributeName . ",
            //     ";
            // }
        }

        // if(!empty($additionalHandling)){
        //     $additionalHandling = '
        //     public function validated()
        //         {' . $additionalHandling . '
        //             return array_merge(parent::validated(), [
        //             ' . $additionalActionsMerge . '
        //             ]);
        //         }else{
        //             return array_filter(parent::validated());
        //         }'; 
        //     $lastBracketPos = strrpos($fileContent, '}');
        //     $fileContent = substr_replace($fileContent, $additionalHandling, $lastBracketPos, 0);
        // }

        $markers = ['||model||', '||table||', '||messages||', '||createRules||', '||updateRules||'];
        $realData = [$modelName, $tableName, $messages, $rules, $rules];
        $template =  str_replace($markers, $realData, $template);
        file_put_contents($filePath, $template);
    }

}
