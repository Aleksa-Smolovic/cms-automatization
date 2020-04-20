<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TableContent;
use App\ForeignKeyInstance;

class GenerateEntity extends Command
{

    private $dataTypes = ['string', 'text', 'integer', 'double', 'date', 'datetime', 'image', 'boolean'];
    private $inputTypes = ['text', 'date', 'datetime', 'file', 'number', 'textarea', 'email', 'password'];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:entity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate entity.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //$this->arguments
        // $entityName = $this->argument('entity'); -> when using inside command

        $modelName = $this->sanitaze($this->ask('Model name'));
        if(file_exists('app/' . $modelName . '.php')){
            $this->error('Model already exists!');
            return;
        }
            
        $tableName = strtolower($this->sanitaze($this->ask('Table name (as is)')));
        $folderName = str_replace("_","-", $tableName);
        if(file_exists('resources/views/admin/' . $folderName)){
            $this->error('Folder ' . $folderName . ' already exists!');
            return;
        }

        $fields = [];
        $moreFields = $moreRelationships = true;

        array_push($fields, $this->fetchField($this));

        while($moreFields){
            $this->line($modelName . ':');
            foreach($fields as $field)
                $this->line('- ' . $field->name . ' (' . $field->dataType . ')');
            if(!($this->confirm('Do you want to add more fields?')))
                break 1;
           array_push($fields, $this->fetchField($this));
        }

        while($moreRelationships){
            $this->line($modelName . ':');
            foreach($fields as $field)
                $this->line('- ' . $field->name . ' (' . $field->dataType . ')');
            if(!($this->confirm('Do you want to add relationship to another entity?')))
                break 1;
           array_push($fields, $this->fetchRelationship($this));
        }

        $entity = ['model_name' => $modelName, 'table_name' => $tableName, 'attributes' => $fields];
        $generator = new \App\Http\Controllers\GeneratorController();

        $this->output->progressStart(10);
        $generator->generate($entity);
        for($i = 0; $i < 10; $i++){
            $this->output->progressAdvance();
        }
        $this->output->progressFinish();
        $this->info('Entity ' . $entity['model_name'] . ' sucesfully generated. Check migrations before running them!');
    }

    function fetchField($state){
        $fieldName =  strtolower($this->sanitaze($state->ask('Table field name')));
        $fieldDisplayName =  $this->sanitaze($state->ask('Field display name'));
        $fieldDataType = $state->choice('Field data type', $this->dataTypes, $this->dataTypes[0]);
        $fieldInputType = $state->choice('Field input type', $this->inputTypes, $this->inputTypes[0]);
        $fieldTableVisibility = $this->confirm('Display field in the table?');
        return new TableContent($fieldDataType, $fieldName, $fieldDisplayName, $fieldInputType, $fieldTableVisibility);
    }

    function fetchRelationship($state){
        $modelName = $this->sanitaze($state->ask('Other entity model name'));
        if(!file_exists('app/' . $modelName . '.php')){
            $this->error('Model with given name does not exist!');
            exit();
        }
        $className = 'App\\' . studly_case(str_singular($modelName));
        if(class_exists($className)) {
            $model = new $className;
        }else{
            $this->error('Model error!');
            exit();
        }
        $tableName = $model->getTable();
        $relationshipName = $this->sanitaze($state->ask('Foreign key name'));
        $relationshipDisplayName = $this->sanitaze($state->ask('Foreign key display name'));
        $modelField = $state->ask('Other entity display field');
        $modelField = trim($modelField) == '' || $modelField == 'id' ? 'id' : $modelField;
        $fieldDataType = 'unsignedBigInteger';
        $fieldInputType = 'foreign_key';
        $fieldTableVisibility = $this->confirm('Display field in the table?');
        $relationship = new ForeignKeyInstance($modelName, $tableName, $modelField);
        return new TableContent($fieldDataType, $relationshipName, $relationshipDisplayName, $fieldInputType, $fieldTableVisibility, $relationship);
    }

    function sanitaze($input){
        if(trim($input) == '')
            exit('Error');
        return $input;
    }

}
