<?php

namespace Generator;

use Artisan;
use Generator\TableContent;
use Generator\ForeignKeyInstance;
use Generator\Constants;
use Generator\Utils;

class Generator
{
    //include: Class -> TableContent, Example resource folder, Admin css/js, templates
    //Tags in web, FileHandle Trait, GeneratorController, AutomatizationInputController

    //TO DO Error Handling

    private $ajaxReturnData = 'returndata';

    public function insertIntoNav($modelName, $tableName)
    {
        $routeIndex = str_replace("_", "-", $tableName);
        $startNeedle = str_replace('||model||', $modelName, Constants::HTML_NEEDLE_START);
        $endNeedle = Constants::HTML_NEEDLE_END;
        $item = $startNeedle . "
        	<li class=\"nav-item\">
                <a class=\"nav-link\" href=\"{{ route('admin/$routeIndex') }}\">
                    <i class=\"fab fa-fw fa-wpforms\"></i>$modelName
                </a>
            </li>
        " . $endNeedle;

        $sidebar = file_get_contents(Constants::SIDEBAR_ITEMS);
        $sidebar .= $item;
        file_put_contents(Constants::SIDEBAR_ITEMS, $sidebar);
    }

    public function insertIntoWeb($tableName, $modelName)
    {
        $tableName = str_replace("_", "-", $tableName);

        $startNeedle = str_replace('||model||', $modelName, Constants::PHP_NEEDLE_START);
        $endNeedle = Constants::PHP_NEEDLE_END;

        $item = $startNeedle . "
    Route::get('/" . $tableName . "', '" . $modelName . "Controller@index')->name('admin/" . $tableName . "');
    Route::get('/" . $tableName . "/deleted', '" . $modelName . "Controller@deleted')->name('admin/" . $tableName . "/deleted');
    Route::get('/" . $tableName . "/{id}', '" . $modelName . "Controller@getOne')->name('admin/" . $tableName . "/fetch');
    Route::delete('/" . $tableName . "/delete/{id}', '" . $modelName . "Controller@destroy')->name('" . $tableName . "/delete');
    Route::put('/" . $tableName . "/restore/{id}', '" . $modelName . "Controller@restore')->name('" . $tableName . "/restore');
    Route::post('/" . $tableName . "/store', '" . $modelName . "Controller@store')->name('" . $tableName . "/store');
    Route::post('/" . $tableName . "/{object}/edit', '" . $modelName . "Controller@edit')->name('" . $tableName . "/edit');
    "
            . $endNeedle .
            "
    //->MARKER";

        $str = file_get_contents(Constants::ROUTES_DIR);
        $str = str_replace("//->MARKER", $item, $str);
        file_put_contents(Constants::ROUTES_DIR, $str);
    }

    public function createIndexDeletedFiles($tableName)
    {
        $tableName = strtolower($tableName);
        if (!file_exists('resources/views/admin/' . $tableName)) {
            if (!mkdir('resources/views/admin/' . $tableName, 0777, true))
                exit('Error creating view files!');
        }

        $indexContent = file_get_contents('generator/templates/index.blade.php');
        $myfile = fopen("resources/views/admin/" . $tableName . "/index.blade.php", "w") or die("Unable to open file!");
        fwrite($myfile, $indexContent);
        fclose($myfile);

        $deletedContent = file_get_contents('generator/templates/deleted.blade.php');
        $deletedFile = fopen("resources/views/admin/" . $tableName . "/deleted.blade.php", "w") or die("Unable to open file!");
        fwrite($deletedFile, $deletedContent);
        fclose($deletedFile);
    }

    public function writeModel($modelName, $tableName, $contentArray)
    {
        $templatePath = 'generator/templates/ModelTemplate';
        $template = file_get_contents($templatePath);
        $filePath = "app/" . $modelName . '.php';

        $dataTypeMutators = ['date', 'datetime', 'image', 'unsignedBigInteger'];
        $mutators = '';
        foreach ($contentArray as $contentInstance) if (in_array($contentInstance->dataType, $dataTypeMutators))
            $mutators .= $this->createMutators($contentInstance, $modelName, $tableName);

        $markers = ['||model||', '||table||', '||mutators||'];
        $realData = [$modelName, $tableName, $mutators];
        $template =  str_replace($markers, $realData, $template);
        file_put_contents($filePath, $template);
    }

    public function writeController($modelName, $tableName, $contentArray)
    {
        $templatePath = 'generator/templates/ControllerTemplate';
        $template = file_get_contents($templatePath);
        $filePath = "app/Http/Controllers/" . $modelName . 'Controller.php';

        $includes = $visibleFields = $relationshipObjects = $foreignKeySelect = '';

        foreach ($contentArray as $contentInstance) if ($contentInstance->foreignKey) {
            $foreignModelName = $contentInstance->foreignKey->modelName;
            $displayField = $contentInstance->foreignKey->displayField;
            $displayField = $displayField == 'id' ? "'id'" : "'id', '" . $displayField . "'";
            $includes .= '
            use App\\' . $foreignModelName . ';';
            $foreignKeySelect .= '
            $' . strtolower($foreignModelName) . ' = ' . $foreignModelName . '::select(' . $displayField . ')->orderBy("id", "DESC")->get();';
            $relationshipObjects .= ', "' . strtolower($foreignModelName) . '"';
        }

        foreach ($contentArray as $contentInstance) if ($contentInstance->isVisible)
            $visibleFields .= ", '" . $contentInstance->name . "'";

        $markers = ['||model||', '||table||', '||attributes||', '||foreignIncludes||', '||foreignFetch||', '||foreignObjects||'];
        $realData = [$modelName, str_replace("_", "-", $tableName), $visibleFields, $includes, $foreignKeySelect, $relationshipObjects];
        $template =  str_replace($markers, $realData, $template);
        file_put_contents($filePath, $template);
    }

    public function changeMigrations($modelName, $tableName, $contentArray)
    {
        $migrationFileName = Utils::findFile(Constants::MIGRATIONS_DIR . '*', 'create_' . $tableName . '_table.php');

        if (!isset($migrationFileName) || !$migrationFileName) {
            echo 'File not found ' . $tableName;
            return;
        }

        $marker = '$table->timestamps();';

        $str = file_get_contents($migrationFileName);
        $data = $this->createMigrationData($modelName, $contentArray);
        $str = str_replace($marker, $data['migrationData'], $str);
        file_put_contents($migrationFileName, $str);

        $this->changeSeeder($modelName, $data['seederData'], true);
    }

    public function createMigrationData($modelName, $contentArray)
    {
        $attributesOutput = str_replace('||model||', $modelName, Constants::PHP_NEEDLE_START);
        $seederData = [];

        foreach ($contentArray as $contentInstance) {
            $contentFieldName = $contentInstance->name;
            $dataTypeInfo = Constants::MIGRATION_DATATYPES[$contentInstance->dataType];
            $seederData[$contentFieldName] = '
            $faker->' . $dataTypeInfo['seederDataType'];
            $dataType = $dataTypeInfo['dataType'];
            $attributesOutput .= '
            $table->' . $dataType . '("' . $contentFieldName . '");
            ';
            if ($dataType == 'unsignedBigInteger')
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
            
            ' . Constants::PHP_NEEDLE_END;

        return ['migrationData' => $attributesOutput, 'seederData' => $seederData];
    }

    public function regenerateMigrations($modelName, $tableName, $contentArray)
    {
        $migrationFileName = Utils::findFile(Constants::MIGRATIONS_DIR . '*', 'create_' . $tableName . '_table.php');

        if (!isset($migrationFileName) || !$migrationFileName) {
            echo 'File not found ' . $tableName;
            return;
        }

        $migrationFile = file_get_contents($migrationFileName);
        $needleStart = str_replace('||model||', $modelName, Constants::PHP_NEEDLE_START);
        $needleEnd = Constants::PHP_NEEDLE_END;
        $data = $this->createMigrationData($modelName, $contentArray);
        $attributesOutput = RemovalUtils::replaceBetween($migrationFile, $needleStart, $needleEnd, $data['migrationData']);

        file_put_contents($migrationFileName, $attributesOutput);
        $this->changeSeeder($modelName, $data['seederData'], false);
    }

    // TODO find replacement laravel fn?
    public function capitalToDashString($str)
    {
        return strtolower(preg_replace('~(?=[A-Z])(?!\A)~', '_', $str));
    }

    public function getHtmlInputs($contentInstance)
    {
        $inputType = $contentInstance->inputType;
        $inputName = $contentInstance->name;
        $inputPlaceholder = $contentInstance->placeholder;
        // TODO switch to constants
        switch ($inputType) {
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
            case 'rich_textarea':
                return '
                        <div class="row">
                            <div class="col-12"> 
                                <div class="form-group">
                                    <label class="col-form-label" for="' . $inputName . '">' . $inputPlaceholder . ' *</label>
                                    <textarea class="form-control rich-textarea" id="' . $inputName . '" name="' . $inputName . '" placeholder="' . $inputPlaceholder . '"></textarea>
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
                $imageHolder = '';
                if ($contentInstance->dataType == 'image') {
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

    // TODO change to use custom objects instead of stdClass, ie. TableContent $tableContent
    public function getTableContent($tableContent)
    {
        switch ($tableContent->dataType) {
            case 'image':
                return '<td class="text-center">
                            <img class="rounded" src="{{ $object->' . $tableContent->name . '}}" width="60">
                        </td>';
                break;
            case 'text':
                return '<td class="text-center">{{ Str::limit(strip_tags($object->' . $tableContent->name . '), 150, "...") }}</td>
                ';
                break;
            default:
                return '<td class="text-center">{{ $object->' . $tableContent->name . ' }}</td>
                ';
                break;
        }
    }

    public function writeIndexBlade($tableName, $contentArray)
    {
        $filePath = "resources/views/admin/" . $tableName . "/index.blade.php";
        $indexContent = file_get_contents($filePath);

        $tableHeaders = $tableContent = $editBtnData = $modalOpenValue = $htmlInputs = $modalCloseValue = '';

        $editBtnData .=  $tableName . '/{{$object->id}}';

        foreach ($contentArray as $column) {
            if ($column->isVisible) {
                $tableHeaders .= '<th class="text-center">' . $column->placeholder . '</th>
                ';
                $tableContent .= $this->getTableContent($column);
            }
            if ($column->inputType == 'file' && $column->dataType == 'image') {
                $modalOpenValue .=     "$('#" . $column->name . "Holder').attr({ 'src': " . $this->ajaxReturnData . "." . $column->name . " });
                ";
                $modalCloseValue = 'var $image = $("#' . $column->name . 'Holder");
            $("#' . $column->name . 'Holder").removeAttr("src").replaceWith($image.clone());';
            } else if ($column->inputType == 'rich_textarea') {
                $modalOpenValue .=     "$('#" . $column->name . "').summernote('code', " . $this->ajaxReturnData . "." . $column->name . ");
                ";
                $modalCloseValue .=     "$('#" . $column->name . "').summernote('code', '');
                ";
            } else {
                $modalOpenValue .=     "$('#" . $column->name . "').val(" . $this->ajaxReturnData . "." . $column->name . " );
                ";
            }
            $htmlInputs .= $this->getHtmlInputs($column);
        }

        $markers = [
            '<!-- Marker Table Heading -->', '<!-- Marker Table Content -->', 'data-route-marker',
            'tableNameMarker', '//OpenModalMarker', '//CloseModalMarker', '<!-- InputsMarker -->'
        ];
        $realData = [$tableHeaders, $tableContent, $editBtnData, $tableName, $modalOpenValue, $modalCloseValue, $htmlInputs];
        $indexContent = str_replace($markers, $realData, $indexContent);
        file_put_contents($filePath, $indexContent);

        $filePath = "resources/views/admin/" . $tableName . "/deleted.blade.php";
        $deletedContent = file_get_contents($filePath);
        $markers = ['<!-- Marker Table Heading -->', '<!-- Marker Table Content -->', 'tableNameMarker',];
        $realData = [$tableHeaders, $tableContent, $tableName];
        $deletedContent = str_replace($markers, $realData, $deletedContent);
        file_put_contents($filePath, $deletedContent);
    }

    public function declareValidation($tableContentInsance)
    {
        //TODO switch to constants
        switch ($tableContentInsance->inputType) {
            case 'textarea':
                return "
            '$tableContentInsance->name' => 'required|max:10000',";
                break;
            case 'rich_textarea':
                return "
                '$tableContentInsance->name' => ['required', new RichTextLength(10000)],";
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
                if ($tableContentInsance->dataType == 'image') {
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
            '$tableContentInsance->name' => 'required|max:255',";
                break;
        }
    }

    public function validationAlerts($contentInstance)
    {
        $inputName = $contentInstance->name;
        $inputPlaceholder = $contentInstance->placeholder;
        switch ($contentInstance->inputType) {
            case 'textarea':
                return "
            '$inputName.required' => 'Morate unijeti " . strtolower($inputPlaceholder) . "!',
            '$inputName.max' => '$inputPlaceholder može sadržati maksimum 10000 karakera!',";
                break;
            case 'rich_textarea':
                return "
                '$inputName.required' => 'Morate unijeti " . strtolower($inputPlaceholder) . "!',";
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
                if ($contentInstance->dataType == 'image') {
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
            '$inputName.max'=> '$inputPlaceholder može sadržati najviše 255 karaktera!',";
                break;
        }
    }

    public function createMutators($tableContentInsance, $modelName, $tableName)
    {
        $fieldName = $tableContentInsance->name;
        switch ($tableContentInsance->dataType) {
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

    public function capitalizeAttributes($str)
    {
        $frags = explode('_', $str);
        for ($i = 0; $i < count($frags); $i++)
            $frags[$i] = strtoupper(substr($frags[$i], 0, 1)) . substr($frags[$i], 1);;
        return join('', $frags);
    }

    public function generate($entity)
    {
        $tableName = strtolower($entity->tableName);
        $modelName = $entity->modelName;
        $contentArray = $entity->fields;

        Artisan::call('make:model ' . $modelName . ' -m');
        Artisan::call('make:controller ' . $modelName . 'Controller');
        Artisan::call('make:seeder ' . $modelName . 'Seeder');
        Artisan::call('make:request ' . $modelName . 'Request');

        $this->writeModel($modelName, $tableName, $contentArray);
        $this->createIndexDeletedFiles(str_replace("_", "-", $tableName));

        $this->insertIntoNav($modelName, $tableName);
        $this->insertIntoWeb($tableName, $modelName);
        $this->writeController($modelName, $tableName, $contentArray);

        $this->changeMigrations($modelName, $tableName, $contentArray);
        $this->writeIndexBlade(str_replace("_", "-", $tableName), $contentArray);
        $this->writeFormRequest($modelName, $tableName, $contentArray);

        Utils::writeToJson($entity);
    }

    public function regenerate($entity)
    {
        $tableName = strtolower($entity->tableName);
        $modelName = $entity->modelName;
        $contentArray = $entity->fields;

        $this->createIndexDeletedFiles(str_replace("_", "-", $tableName));
        $this->writeIndexBlade(str_replace("_", "-", $tableName), $contentArray);
        $this->writeController($modelName, $tableName, $contentArray);
        $this->writeFormRequest($modelName, $tableName, $contentArray);

        $this->regenerateMigrations($modelName, $tableName, $contentArray);
        $this->writeModel($modelName, $tableName, $contentArray);
        Utils::writeToJson($entity);
    }

    public function changeSeeder($modelName, $seederData, $isNewEntity)
    {
        $templatePath = 'generator/templates/SeederTemplate';
        $template = file_get_contents($templatePath);

        $folderPath = 'database/seeds/';
        $seederFileName =  $folderPath . $modelName . 'Seeder.php';
        $str = file_get_contents($seederFileName);
        if ($str === false || empty($str))
            exit($seederFileName);
        $seedOutput = '';
        foreach ($seederData as $key => $value) {
            $seedOutput .= '
                "' . $key . '" => ' . $value;
        }

        $markers = ['||model||', '||data||'];
        $realData = [$modelName, $seedOutput];
        $template =  str_replace($markers, $realData, $template);
        file_put_contents($seederFileName, $template);

        if ($isNewEntity) {
            $dbSeederFile =  $folderPath . 'DatabaseSeeder.php';
            $dbSeederText = file_get_contents($dbSeederFile);
            $seederInitialization = '$this->call(' . $modelName . 'Seeder::class);
                ';
            $initializationPos = strpos($dbSeederText, '}');
            $dbSeederOutput = substr_replace($dbSeederText, $seederInitialization, $initializationPos - 1, 0);
            file_put_contents($dbSeederFile, $dbSeederOutput);
        }
    }

    public function writeFormRequest($modelName, $tableName, $contentArray)
    {
        $templatePath = 'generator/templates/FormRequestTemplate';
        $template = file_get_contents($templatePath);

        $filePath = "app/Http/Requests/" . $this->capitalizeAttributes($modelName) . 'Request.php';
        $fileContent = file_get_contents($filePath);
        $tableName = str_replace("_", "-", $tableName);

        $rules = $messages = $additionalHandling = $additionalActionsMerge = '';

        foreach ($contentArray as $contentInstance) {
            $rules .= $this->declareValidation($contentInstance);
            $messages .= $this->validationAlerts($contentInstance);
        }

        $markers = ['||model||', '||table||', '||messages||', '||createRules||', '||updateRules||'];
        $realData = [$modelName, $tableName, $messages, $rules, $rules];
        $template =  str_replace($markers, $realData, $template);
        file_put_contents($filePath, $template);
    }
}
