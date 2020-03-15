<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;
use App\TableContent;

class TestController extends Controller
{
    //include: Class -> TableContent, Example resource folder, Admin css/js,
    //Tags in web and index.blade(nav), FileHandle Trait, TestController, AutomatizationInputController

    //TO DO Error Handling
    //TO DO _ -> - za spaceove
    //TO DO upisati u jedan fajl? writeController   
    //TO DO automateV4 -> da li funkcije da zovu jedna drugu?

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

        $file_path = "../resources/views/layouts/index.blade.php";

        $str = file_get_contents($file_path);
        $str = str_replace("<!-- MARKER -->", $item, $str);
        file_put_contents($file_path, $str);
    }

    public function insertIntoWeb($tableName){
        $controllerName = $this->capitalizeAttributes($tableName);
        $tableName = str_replace("_","-", $tableName);

        $item = "
    Route::get('/admin/" . $tableName . "', '" . $controllerName . "Controller@index')->name('admin/" . $tableName . "');
    Route::get('/admin/" . $tableName . "/{id}', '" . $controllerName . "Controller@getOne')->name('admin/" . $tableName . "/fetch');
    Route::get('/admin/" . $tableName . "/deleted', '" . $controllerName . "Controller@deleted')->name('admin/" . $tableName . "/deleted');
    Route::delete('/admin/" . $tableName . "/delete/{id}', '" . $controllerName . "Controller@destroy')->name('" . $tableName . "/delete');
    Route::post('/admin/" . $tableName . "/restore/{id}', '" . $controllerName . "Controller@restore')->name('" . $tableName . "/restore');
    Route::post('/admin/" . $tableName . "/store', '" . $controllerName . "Controller@store')->name('" . $tableName . "/store');
    Route::post('/admin/" . $tableName . "/edit', '" . $controllerName . "Controller@edit')->name('" . $tableName . "/edit');
    //->MARKER";

        $file_path = "../routes/web.php";

        $str = file_get_contents($file_path);
        $str = str_replace("//->MARKER", $item, $str);
        file_put_contents($file_path, $str);
    }

    //TO DO vidjeti moze li create or replace na file ili folder?
    public function createIndexDeletedFiles($tableName){
        $tableName = strtolower($tableName);
        if (!file_exists('../resources/views/admin/' . $tableName)) {
            if(!mkdir('../resources/views/admin/' . $tableName, 0777, true));
        }else{
            echo $tableName;
        }

        //TO DO povuci sa interneta fajl?
        $indexContent = file_get_contents('../resources/views/admin/example/index.blade.php');
        $myfile = fopen("../resources/views/admin/" . $tableName . "/index.blade.php", "w") or die("Unable to open file!");
        fwrite($myfile, $indexContent);
        fclose($myfile);

        $deletedContent = file_get_contents('../resources/views/admin/example/deleted.blade.php');
        $deletedFile = fopen("../resources/views/admin/" . $tableName . "/deleted.blade.php", "w") or die("Unable to open file!");
        fwrite($deletedFile, $deletedContent);
        fclose($deletedFile);
    }

    public function createModelController($modelName, $tableName, $dateTypesArray){
        Artisan::call('make:model ' . $modelName . ' -m');
        Artisan::call('make:controller ' . $this->capitalizeAttributes($tableName) . 'Controller');

        $file_path = "../app/" . $modelName . '.php';

        $includesMarker = 'use Illuminate\Database\Eloquent\Model;';

        $includes = $includesMarker . '
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Traits\FileHandling;';

        $str = file_get_contents($file_path);
        $str = str_replace($includesMarker, $includes, $str);

        $mutators = '';
        for($i = 0; $i < count($dateTypesArray); $i++){
            $mutators .= $this->createMutators($dateTypesArray[$i]);
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

    public function writeController($modelName, $tableName){
        $controllerName = $this->capitalizeAttributes($tableName);
        $file_path = "../app/Http/Controllers/" . $controllerName . 'Controller.php';
        $str = file_get_contents($file_path);

        $includesMarker = 'use Illuminate\Http\Request;';
        $includes = $includesMarker . '
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\\' . $modelName . ';';
        
        $str = file_get_contents($file_path);
        $str = str_replace($includesMarker, $includes, $str);

        $content = '
    public function index(){
        $objects = ' . $modelName . '::orderBy("id", "DESC")->get();
        return view("admin.' . str_replace("_","-", $tableName) . '.index",  compact("objects"));
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
        return view("admin.' . str_replace("_","-", $tableName) . '.deleted")->withObjects( ' . $modelName . '::onlyTrashed()->get());
    }
    
    public function restore($id){
        ' . $modelName . '::where("id", $id)->restore();
		return back()->with("success", "Objekat uspješno aktiviran.");
    }
    
    //';

        $str = str_replace('//', $content, $str);
        file_put_contents($file_path, $str);

    }

    public function changeMigrations($tableName, $contentArray){

        $filename = "../database/migrations/*";
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

        for($i = 0; $i < count($contentArray); $i++){
            
            switch($contentArray[$i]->dataType){
                case 'image':
                    $dataType = 'text';
                    break;
                case 'text':
                    $dataType = 'text';
                    break;
                case 'string':
                    $dataType = 'string';
                    break;
                case 'boolean':
                    $dataType = 'boolean';
                    break;
                case 'integer':
                    $dataType = 'integer';
                    break;
                case 'date':
                    $dataType = 'date';
                    break;
                case 'datetime':
                    $dataType = 'datetime';
                    break;
                case 'double':
                    $dataType = 'double';
                    break;
                default:
                    //TO DO bolje rjesenje
                    $dataType = 'unsignedBigInteger';
                    break;
            }

            $attributesOutput .= '$table->' . $dataType . '("' . $contentArray[$i]->name . '");
            ';

            if($dataType == 'unsignedBigInteger') 
                $attributesOutput .= '$table->foreign("' .  $contentArray[$i]->name . '")->references("id")->on("' .  $contentArray[$i]->dataType . '");
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
    }

    public function automateV4(){
        $tableName = 'Blogs';

        $title = new TableContent('string', 'title', 'Naziv', 'text', null);
        $text = new TableContent('text', 'text', 'Tekst', 'txt', null);
        $image = new TableContent('text', 'image', 'Slika', 'file', ['type' => 'image']);
        $date = new TableContent('date', 'date_from', 'Datum od', 'date', null);
        $timestamp = new TableContent('datetime', 'timestamp_from', 'Timestamp Od', 'datetime', null);
        $double = new TableContent('double', 'amount', 'Vrijednost', 'number', null);

        $contentArray = [$title, $text, $image, $date, $timestamp, $double];
        $dateTypesArray = [];
        for($i = 0; $i < count($contentArray); $i++){
            if($contentArray[$i]->dataType == 'date' || $contentArray[$i]->dataType == 'datetime')
                array_push($dateTypesArray, $contentArray[$i]);
        }

        $this->insertIntoIndex($tableName);
        $this->insertIntoWeb($tableName);
        $this->createIndexDeletedFiles($tableName);
        $this->createModelController($tableName, $dateTypesArray);
        $this->writeController($tableName);

        $this->changeMigrations(strtolower($tableName), $contentArray);
        $this->writeIndexBlade(strtolower($tableName), $contentArray);
        $this->controllerStore($tableName, $contentArray);
    }

    public function capitalToDashString($str){
        return strtolower(preg_replace('~(?=[A-Z])(?!\A)~', '_', $str));
    }

    public function getHtmlInputs(TableContent $tableContentInsance){

        switch($tableContentInsance->inputType){
            case 'txt':
                return '
                    <div class="row">
                        <div class="col-12"> 
                            <div class="form-group">
                                <label class="col-form-label" for="' . $tableContentInsance->name . '">' . $tableContentInsance->placeholder . ' *</label>
                                <textarea class="form-control" id="' . $tableContentInsance->name . '" name="' . $tableContentInsance->name . '" placeholder="' . $tableContentInsance->placeholder . '"></textarea>
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
                            <label class="col-form-label" for="' . $tableContentInsance->name . '">' . $tableContentInsance->placeholder . ' *</label>
                            <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                <input name="' . $tableContentInsance->name . '" id="' . $tableContentInsance->name . '" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" />
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
                            <label class="col-form-label" for="' . $tableContentInsance->name . '">' . $tableContentInsance->placeholder . ' *</label>
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input id="' . $tableContentInsance->name . '" type="text" name="' . $tableContentInsance->name . '" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
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
                if($tableContentInsance->additionalData['type'] == 'image'){
                    $imageHolder = '
                <div class="row">
                    <div class="col-12">
                        <img width="100%" style="max-height:25%" id="' . $tableContentInsance->name . 'Holder"/>
                    </div>
                </div>
                ';
                }
                return $imageHolder . '
                    <div class="row">
						<div class="col-12"> 
							<div class="form-group">
								<label class="col-form-label" for="' . $tableContentInsance->name . '">' . $tableContentInsance->placeholder . ' *</label>
								<input type="file" id="' . $tableContentInsance->name . '" class="form-control" name="' . $tableContentInsance->name . '"/>
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
                            <label class="col-form-label" for="' . $tableContentInsance->name . '">' . $tableContentInsance->placeholder . ' *</label>
                            <input id="' . $tableContentInsance->name . '" class="form-control" type="' . $tableContentInsance->inputType . '" placeholder="' . $tableContentInsance->placeholder . '" name="' . $tableContentInsance->name . '">
                        </div>
                    </div>
                </div>
                ';
                break;
        }

    }

    public function getTableContent(TableContent $tableContent){
        switch($tableContent->additionalData['type']){
            case 'image':
                return '<td class="text-center">
                            <img class="rounded" src="{{ asset("$object->' . $tableContent->name . '")}}" width="60">
                        </td>';
                break;
            default:
                return '<td class="text-center">{{ $object->' . $tableContent->name . ' }}</td>
                ';
                break;
        }
    }

    public function writeIndexBlade($tableName, $contentArray){
        $file_path = "../resources/views/admin/" . $tableName . "/index.blade.php";
        $indexContent = file_get_contents($file_path);

        $tableHeaders = $tableContent = $editBtnData = $modalOpenValue = $htmlInputs = $modalCloseValue = '';

        $editBtnData .=  $tableName . '/{{$object->id}}';

        for($i = 0; $i < count($contentArray); $i++){
            $tableHeaders .= '<th class="text-center">' . $contentArray[$i]->placeholder . '</th>
            ';
            $tableContent .= $this->getTableContent($contentArray[$i]);
            if($contentArray[$i]->inputType == 'file' && $contentArray[$i]->additionalData['type'] == 'image'){
                $modalOpenValue .= 	"$('#" . $contentArray[$i]->name . "Holder').attr({ 'src': " . $this->ajaxReturnData .".". $contentArray[$i]->name . " });
                ";
                $modalCloseValue = 'var $image = $("#' . $contentArray[$i]->name . 'Holder");
            $("#' . $contentArray[$i]->name . 'Holder").removeAttr("src").replaceWith($image.clone());';
            }else{
                $modalOpenValue .= 	"$('#" . $contentArray[$i]->name . "').val(" . $this->ajaxReturnData .".". $contentArray[$i]->name . " );
                ";
            }
            $htmlInputs .= $this->getHtmlInputs($contentArray[$i]);
        }

        $indexContent = str_replace("<!-- Marker Table Heading -->", $tableHeaders, $indexContent);
        $indexContent = str_replace("<!-- Marker Table Content -->", $tableContent, $indexContent);
        $indexContent = str_replace("data-route-marker", $editBtnData, $indexContent);
        $indexContent = str_replace("tableNameMarker", $tableName, $indexContent);
        $indexContent = str_replace("//OpenModalMarker", $modalOpenValue, $indexContent);
        $indexContent = str_replace("//CloseModalMarker", $modalCloseValue, $indexContent);
        $indexContent = str_replace("<!-- InputsMarker -->", $htmlInputs, $indexContent);
        file_put_contents($file_path, $indexContent);

        $file_path = "../resources/views/admin/" . $tableName . "/deleted.blade.php";
        $deletedContent = file_get_contents($file_path);
        $deletedContent = str_replace("<!-- Marker Table Heading -->", $tableHeaders, $deletedContent);
        $deletedContent = str_replace("<!-- Marker Table Content -->", $tableContent, $deletedContent);
        $deletedContent = str_replace("tableNameMarker", $tableName, $deletedContent);
        file_put_contents($file_path, $deletedContent);
    }

    public function controllerStore($modelName, $tableName, $contentArray){
        $file_path = "../app/Http/Controllers/" . $this->capitalizeAttributes($tableName) . 'Controller.php';
        $str = file_get_contents($file_path);

        $declaringValidation = '$data = $request->validate([';
        
        $validationAlerts = '
        ],
        [';

        $additionalHandling = '';

        for($i = 0; $i < count($contentArray); $i++){
            $declaringValidation .= $this->declareValidation($contentArray[$i]);
            $validationAlerts .= $this->validationAlerts($contentArray[$i]);
            if($contentArray[$i]->inputType == 'file'){
                $additionalHandling .= '
            $data["' . $contentArray[$i]->name . '"] = ' . $modelName . '::storeFile($data["' . $contentArray[$i]->name . '"], "' . $tableName . '");';
            }     
        }
        
        $validationAlerts .= '
        ]);';
        
        $content = '
    public function store(Request $request){
        ' . $declaringValidation . $validationAlerts . $additionalHandling; 
        
        $content.= '

        $data["create_user_id"] = Auth::user()->id;

        ' . $modelName . '::create($data);

        return "Done";
         
    }
    //';

        $str = str_replace('//', $content, $str);
        file_put_contents($file_path, $str);

        $this->controllerEdit($modelName, $tableName, $contentArray);
    }

    public function declareValidation(TableContent $tableContentInsance){

        switch($tableContentInsance->inputType){
            case 'txt':
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
                if($tableContentInsance->additionalData['type'] == 'image'){
                    return "
            '$tableContentInsance->name' => 'required|max:5000|mimes:jpeg,png,jpg,gif,svg',";
                }
                return "
            '$tableContentInsance->name' => 'required|max:5000|mimes:pdf,docx',";
                break;
            default:
                return "
            '$tableContentInsance->name' => 'required|max:191',";
                break;
        }

    }

    public function validationAlerts(TableContent $tableContentInsance){

        switch($tableContentInsance->inputType){
            case 'txt':
                return "
            '$tableContentInsance->name.required' => 'Morate unijeti " . strtolower($tableContentInsance->placeholder) . "!',
            '$tableContentInsance->name.max' => '$tableContentInsance->placeholder može sadržati maksimum 10000 karakera!',";
                break;
            case 'date':
                return "
            '$tableContentInsance->name.required' => 'Morate unijeti " . strtolower($tableContentInsance->placeholder) . "!',
            '$tableContentInsance->name.date_format' => '$tableContentInsance->placeholder mora biti dormata d/m/y!',";
                break;
            case 'datetime':
                return "
            '$tableContentInsance->name.required' => 'Morate unijeti " . strtolower($tableContentInsance->placeholder) . "!',
            '$tableContentInsance->name.date_format' => '$tableContentInsance->placeholder mora biti dormata d/m/y h:i:s!',";
                break;    
            case 'file':
                if($tableContentInsance->additionalData['type'] == 'image'){
                    return "
            '$tableContentInsance->name.required' => 'Morate unijeti " . strtolower($tableContentInsance->placeholder) . "!',
            '$tableContentInsance->name.max' => 'Maksimalna veličina " . strtolower($tableContentInsance->placeholder) . " je 5mb!',
            '$tableContentInsance->name.mimes' => '$tableContentInsance->placeholder može biti formata: jpeg,png,jpg,gif,svg!',";
                }
                return "
            '$tableContentInsance->name.required' => 'Morate unijeti " . strtolower($tableContentInsance->placeholder) . "!',
            '$tableContentInsance->name.max' => 'Maksimalna veličina " . strtolower($tableContentInsance->placeholder) . " je 5mb!',
            '$tableContentInsance->name.mimes' => '$tableContentInsance->placeholder može biti formata: pdf,docx!',";
                break;
            default:
                return "
            '$tableContentInsance->name.required'=> 'Morate unijeti " . strtolower($tableContentInsance->placeholder) . "!',
            '$tableContentInsance->name.max'=> '$tableContentInsance->placeholder može sadržati najviše 191 karaktera!',";
                break;
        }

    }

    public function controllerEdit($modelName, $tableName, $contentArray){
        $file_path = "../app/Http/Controllers/" . $this->capitalizeAttributes($tableName) . 'Controller.php';
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
       
        return "Done";
         
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
        }
    }

    public function capitalizeAttributes($str) {
        $frags = explode('_', $str);
        for ($i = 0; $i < count($frags); $i++) {
          $frags[$i] = strtoupper(substr($frags[$i], 0, 1)) . substr($frags[$i], 1);;
        }
        return join('', $frags);
    }

    public function automateGenerate($table){
        //tableName = blog_categories
        //modelName = BlogCategory
        $tableName = strtolower($table['table_name']);
        $modelName = $table['model_name'];

        $dateTypesArray = [];
        $contentArray = $table['attributes'];
        for($i = 0; $i < count($contentArray); $i++){
            if($contentArray[$i]->dataType == 'date' || $contentArray[$i]->dataType == 'datetime')
                array_push($dateTypesArray, $contentArray[$i]);
        }

        $this->insertIntoIndex($modelName, $tableName);
        $this->insertIntoWeb($tableName);
        $this->createIndexDeletedFiles(str_replace("_","-", $tableName));
        $this->createModelController($modelName, $tableName, $dateTypesArray);
        $this->writeController($modelName, $tableName);

        $this->changeMigrations($tableName, $contentArray);
        $this->writeIndexBlade(str_replace("_","-", $tableName), $contentArray);
        $this->controllerStore($modelName, $tableName, $contentArray);
    }

   

}
