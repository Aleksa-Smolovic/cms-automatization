<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Generator\TableContent;
use Generator\ForeignKeyInstance;
use Generator\Entity;
use Generator\Utils;
use Generator\CommandUtils;
use Generator\Generator;

class GenerateEntity extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entity:generate';

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

        $modelName = Utils::sanitaze($this->ask('Model name'));
        if(file_exists('app/' . $modelName . '.php')){
            $this->error('Model already exists!');
            return;
        }
            
        $tableName = strtolower(Utils::sanitaze($this->ask('Table name (as is)')));
        $folderName = str_replace("_","-", $tableName);
        if(file_exists('resources/views/admin/' . $folderName)){
            $this->error('Folder ' . $folderName . ' already exists!');
            return;
        }

        $fields = [];
        $moreFields = $moreRelationships = true;

        array_push($fields, CommandUtils::fetchField($this));

        while($moreFields){
            $this->line($modelName . ':');
            foreach($fields as $field)
                $this->line('- ' . $field->name . ' (' . $field->dataType . ')');
            if(!($this->confirm('Do you want to add more fields?')))
                break 1;
           array_push($fields, CommandUtils::fetchField($this));
        }

        while($moreRelationships){
            $this->line($modelName . ':');
            foreach($fields as $field)
                $this->line('- ' . $field->name . ' (' . $field->dataType . ')');
            if(!($this->confirm('Do you want to add relationship to another entity?')))
                break 1;
           array_push($fields, CommandUtils::fetchRelationship($this));
        }

        $generator = new Generator();
        $this->output->progressStart(10);
        
        $entity = new Entity($modelName, $tableName, $fields);
        $generator->generate($entity);
        $this->output->progressFinish();
        $this->info('Entity ' . $entity->modelName . ' sucesfully generated. Check migrations before running them!');
    }

}
