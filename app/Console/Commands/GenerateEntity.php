<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TableContent;

class GenerateEntity extends Command
{

    private $dataTypes = ['String', 'Text', 'Integer', 'Double', 'Date', 'datetime', 'image'];
    private $inputTypes = ['text', 'date', 'datetime', 'file', 'number'];

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
        //TODO check if exists
        //TODO check errors (empty)
        $tableName = $this->ask('Table name (as is)');

        $fields = [];
        $moreFields = true;

        array_push($fields, $this->fetchField($this));

        while($moreFields){
           if(!($this->confirm('Do you want to add more fields?')))
                break 1;
           array_push($fields, $this->fetchField($this));
        }

        $entity = ['model_name' => $modelName, 'table_name' => $tableName, 'attributes' => $fields];
        $generator = new \App\Http\Controllers\TestController();
        // $generator->automateGenerate($entity);

        $this->output->progressStart(10);
        for($i = 0; $i < 10; $i++){
            sleep(0.25);
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
        $fieldAdditionalData = $state->choice('Field additional data', ['No', 'Image'], 'No');
        $fieldAdditionalData = $fieldAdditionalData == 'No' ? null : $fieldAdditionalData;
        return new TableContent($fieldDataType, $fieldName, $fieldDisplayName, $fieldInputType, $fieldAdditionalData);
    }

}
