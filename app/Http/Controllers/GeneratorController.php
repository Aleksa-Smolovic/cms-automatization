<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use App\TableContent;
use App\ForeignKeyInstance;

class GeneratorController extends Controller
{
    //include: Class -> TableContent, Example resource folder, Admin css/js,
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

        $file_path = "resources/views/layouts/index.blade.php";

        $str = file_get_contents($file_path);
        $str = str_replace("<!-- MARKER -->", $item, $str);
        file_put_contents($file_path, $str);
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

        $file_path = "routes/web.php";

        $str = file_get_contents($file_path);
        $str = str_replace("//->MARKER", $item, $str);
        file_put_contents($file_path, $str);
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

    public function createModelController($modelName, $tableName, $contentArray){
        Artisan::call('make:model ' . $modelName . ' -m');
        Artisan::call('make:controller ' . $this->capitalizeAttributes($tableName) . 'Controller');
        Artisan::call('make:seeder ' . $modelName . 'Seeder');

        $file_path = "app/" . $modelName . '.php';

        $includesMarker = 'use Illuminate\Database\Eloquent\Model;';

        $includes = $includesMarker . '
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Traits\FileHandling;';

        $str = file_get_contents($file_path);
        $str = str_replace($includesMarker, $includes, $str);

        $dataTypeMutators = ['date', 'datetime', 'image', 'unsignedBigInteger'];
        $mutators = '';

        foreach($contentArray as $contentInstance){
            if(in_array($contentInstance->dataType, $dataTypeMutators))
                $mutators .= $this->createMutators($contentInstance);
        }

        $content = '
    use SoftDeletes, FileHandling;

    protected $table = "' . $tableName . '";
    
    public $primaryKey = "id";
    protected $guarded = [];
    ' . $mutators;

        $str = str_replace('//', $content, $str);
        file_put_contents($file_path, $str);
    }

    public function writeController($modelName, $tableName, $contentArray){
        $controllerName = $this->capitalizeAttributes($tableName);
        $file_path = "app/Http/Controllers/" . $controllerName . 'Controller.php';
        $str = file_get_contents($file_path);

        $includesMarker = 'use Illuminate\Http\Request;';
        $includes = $includesMarker . '
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\\' . $modelName . ';';

        $relationshipObjects = $foreignKeySelect = '';

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

        $str = file_get_contents($file_path);
        $str = str_replace($includesMarker, $includes, $str);

        $visibleFields = "'id'";
        foreach($contentArray as $contentInstance) if($contentInstance->isVisible)
            $visibleFields .= ", '" . $contentInstance->name . "'";
        
        $content = '
    public function index(){
        $objects = ' . $modelName . '::select(' . $visibleFields . ')->orderBy("id", "DESC")->get();
        ' . $foreignKeySelect . '
        return view("admin.' . str_replace("_","-", $tableName) . '.index",  compact("objects"' . $relationshipObjects . ' ));
    }

    public function getOne($id){
        $object = ' . $modelName . '::find($id);
        return $object ? $object : null;
    }
    
    public function destroy($id){
        $object = ' . $modelName . '::find($id);
        if($object)
            $object->delete();
        return back()->with("success", "Element uspješno obrisan!");
    }
    
    public function deleted()
	{
        return view("admin.' . str_replace("_","-", $tableName) . '.deleted")->withObjects( ' . $modelName . '::select(' . $visibleFields . ')->onlyTrashed()->get());
    }
    
    public function restore($id){
        ' . $modelName . '::where("id", $id)->restore();
		return back()->with("success", "Objekat uspješno aktiviran.");
    }
    
    //';

        $str = str_replace('//', $content, $str);
        file_put_contents($file_path, $str);
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

            $seederData[$contentInstance->name] = '
                $faker->' . $seederDataType;

            $attributesOutput .= '$table->' . $dataType . '("' . $contentInstance->name . '");
            ';

            if($dataType == 'unsignedBigInteger') 
                $attributesOutput .= '$table->foreign("' .  $contentInstance->name . '")->references("id")->on("' .  $contentInstance->foreignKey->tableName . '");
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
        $file_path = "resources/views/admin/" . $tableName . "/index.blade.php";
        $indexContent = file_get_contents($file_path);

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

        $indexContent = str_replace("<!-- Marker Table Heading -->", $tableHeaders, $indexContent);
        $indexContent = str_replace("<!-- Marker Table Content -->", $tableContent, $indexContent);
        $indexContent = str_replace("data-route-marker", $editBtnData, $indexContent);
        $indexContent = str_replace("tableNameMarker", $tableName, $indexContent);
        $indexContent = str_replace("//OpenModalMarker", $modalOpenValue, $indexContent);
        $indexContent = str_replace("//CloseModalMarker", $modalCloseValue, $indexContent);
        $indexContent = str_replace("<!-- InputsMarker -->", $htmlInputs, $indexContent);
        file_put_contents($file_path, $indexContent);

        $file_path = "resources/views/admin/" . $tableName . "/deleted.blade.php";
        $deletedContent = file_get_contents($file_path);
        $deletedContent = str_replace("<!-- Marker Table Heading -->", $tableHeaders, $deletedContent);
        $deletedContent = str_replace("<!-- Marker Table Content -->", $tableContent, $deletedContent);
        $deletedContent = str_replace("tableNameMarker", $tableName, $deletedContent);
        file_put_contents($file_path, $deletedContent);
    }

    public function controllerStore($modelName, $tableName, $contentArray){
        $file_path = "app/Http/Controllers/" . $this->capitalizeAttributes($tableName) . 'Controller.php';
        $str = file_get_contents($file_path);

        $declaringValidation = '$data = $request->validate([';
        
        $validationAlerts = '
        ],
        [';

        $additionalHandling = '';

        foreach($contentArray as $contentInstance){
            $declaringValidation .= $this->declareValidation($contentInstance);
            $validationAlerts .= $this->validationAlerts($contentInstance);
            if($contentInstance->inputType == 'file')
                $additionalHandling .= '
            $data["' . $contentInstance->name . '"] = ' . $modelName . '::storeFile($data["' . $contentInstance->name . '"], "' . $tableName . '");';
        }
        
        $validationAlerts .= '
        ]);';
        
        $content = '
    public function store(Request $request){
        ' . $declaringValidation . $validationAlerts . $additionalHandling; 
        
        $content.= '

        $data["create_user_id"] = Auth::user()->id;

        ' . $modelName . '::create($data);


        return response()->json(["success" => "success"], 200);
         
    }
    //';

        $str = str_replace('//', $content, $str);
        file_put_contents($file_path, $str);

        $this->controllerEdit($modelName, $tableName, $contentArray);
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

    public function controllerEdit($modelName, $tableName, $contentArray){
        $file_path = "app/Http/Controllers/" . $this->capitalizeAttributes($tableName) . 'Controller.php';
        $str = file_get_contents($file_path);

        $declaringValidation = '$data = $request->validate([
            "id" => "required",';
        
        $validationAlerts = '
        ],
        [';

        $additionalHandling = '';

        for($i = 0; $i < count($contentArray); $i++){
            if($contentArray[$i]->inputType == 'file'){
                $additionalHandling .= '
                if( $request->hasFile( "'. $contentArray[$i]->name .'" ) ) 
                    $data["' . $contentArray[$i]->name . '"] = ' . $modelName . '::storeFile($request["' . $contentArray[$i]->name . '"], "' . $tableName . '");';
            }else{
                $declaringValidation .= $this->declareValidation($contentArray[$i]);
                $validationAlerts .= $this->validationAlerts($contentArray[$i]);
            }
              
            
        }
        
        $validationAlerts .= '
        ]);';
        
        $content = '
    public function edit(Request $request){
        ' . $declaringValidation . $validationAlerts . $additionalHandling; 
        
        $content.= '

        $object = ' . $modelName . '::find($data["id"]);
        $data["update_user_id"] = Auth::user()->id;

        $object->fill($data);
        $object->save();
       
        return response()->json(["success" => "success"], 200);
         
    }';

        $str = str_replace('//', $content, $str);
        file_put_contents($file_path, $str);

    }

    public function createMutators(TableContent $tableContentInsance){
        switch($tableContentInsance->dataType){
            case 'date':
                return '
            public function get' . $this->capitalizeAttributes($tableContentInsance->name) . 'Attribute($value){
                return Carbon::parse($value)->format("d/m/Y");
            }
            
            public function set' . $this->capitalizeAttributes($tableContentInsance->name)  . 'Attribute($value)
            {
                $this->attributes["' . $tableContentInsance->name . '"] = Carbon::createFromFormat("d/m/Y", $value);
            }';
                break;
            case 'datetime':
                return '
            public function get' . $this->capitalizeAttributes($tableContentInsance->name) . 'Attribute($value){
                return Carbon::parse($value)->format("d/m/Y H:i:s");
            }
            
            public function set' . $this->capitalizeAttributes($tableContentInsance->name)  . 'Attribute($value)
            {
                $this->attributes["' . $tableContentInsance->name . '"] = Carbon::createFromFormat("d/m/Y H:i:s", $value);
            }';
                break;
            case 'image':
                    return '
            public function get' . $this->capitalizeAttributes($tableContentInsance->name) . 'Attribute($value){
                return strpos($value, "http") === false ? asset($value) : $value;
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

        $this->createModelController($modelName, $tableName, $contentArray);
        $this->createIndexDeletedFiles(str_replace("_","-", $tableName));

        $this->insertIntoIndex($modelName, $tableName);
        $this->insertIntoWeb($tableName);
        $this->writeController($modelName, $tableName, $contentArray);

        $this->changeMigrations($modelName, $tableName, $contentArray);
        $this->writeIndexBlade(str_replace("_","-", $tableName), $contentArray);
        $this->controllerStore($modelName, $tableName, $contentArray);
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
            "create_user_id" => $faker->numberBetween($min = 1, $max = 10),
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

}
