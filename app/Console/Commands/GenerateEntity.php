<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TableContent;

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

        $modelName = $this->ask('Model name');
        if(trim($modelName) == ''){
            return;
        }else if(file_exists('app/' . $modelName . '.php')){
            $this->error('Model already exists!');
            return;
        }
            
        $tableName = $this->ask('Table name (as is)');
        $folderName = strtolower(str_replace("_","-", $tableName));
        if(trim($tableName) == ''){
            return;
        }else if(file_exists('resources/views/admin/' . $folderName)){
            $this->error('Folder ' . $folderName . ' already exists!');
            return;
        }

        $fields = [];
        $moreFields = true;

        array_push($fields, $this->fetchField($this));

        while($moreFields){
            $this->line($modelName . ':');
            for($i = 0; $i < count($fields); $i ++)
                $this->line('- ' . $fields[$i]->name . ' (' . $fields[$i]->dataType . ')');
            if(!($this->confirm('Do you want to add more fields?')))
                break 1;
           array_push($fields, $this->fetchField($this));
        }

        $entity = ['model_name' => $modelName, 'table_name' => $tableName, 'attributes' => $fields];
        $generator = new \App\Http\Controllers\GeneratorController();

        $this->output->progressStart(10);
        $generator->generate($entity);
        for($i = 0; $i < 10; $i++){
            // sleep(0.25);
            $this->output->progressAdvance();
        }
        $this->output->progressFinish();
        $this->info('Entity ' . $entity['model_name'] . ' sucesfully generated. Check migrations before running them!');
    }

    function fetchField($state){
        $fieldName = $state->ask('Table field name');
        $fieldDisplayName = $state->ask('Field display name');
        $fieldDataType = $state->choice('Field data type', $this->dataTypes, $this->dataTypes[0]);
        $fieldInputType = $state->choice('Field input type', $this->inputTypes, $this->inputTypes[0]);
        $fieldTableVisibility = $this->confirm('Display field in the table?');
        return new TableContent($fieldDataType, $fieldName, $fieldDisplayName, $fieldInputType, $fieldTableVisibility);
    }

}
