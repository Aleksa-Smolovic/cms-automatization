<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Generator\Entity;
use Generator\Constants;
use Generator\Utils;
use Generator\CommandUtils;
use Generator\TableContent;
use Generator\Generator;
use Generator\RemovalUtils;

class RegenerateEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entity:regenerate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate generated entity.';

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
     * @return int
     */
    public function handle()
    {
        $modelName = Utils::sanitaze($this->ask('Model name'));
        $entityFile = Constants::JSON_DIR . $modelName . '.json';
        if(!file_exists($entityFile)){
            $this->error('Entity does not exist!');
            return;
        }

        $jsonObj = file_get_contents($entityFile);
        $entity = Entity::fromJSON($jsonObj);

        if($this->confirm('Do you want to remove fields?')){
            $existingFields = [];
            foreach($entity->fields as $field)
                array_push($existingFields, '- ' . $field->name . ' (' . $field->dataType . ')');

            $removedFields = $this->choice('Select field: ', $existingFields,
            null,
            $maxAttempts = null,
            $allowMultipleSelections = true);

            foreach($removedFields as $removedField){
                $removedFieldIndex = array_search($removedField, $existingFields);
                unset($entity->fields[$removedFieldIndex]);
                unset($existingFields[$removedFieldIndex]);
            }
            $entity->fields = array_values($entity->fields);

            $this->line($entity->modelName . ':');
            foreach($existingFields as $field)
                $this->line($field);
        }

        $moreFields = $moreRelationships = true;

        if($this->confirm('Do you want add more fields?')){

            while($moreFields){
                $this->line($entity->modelName . ':');
                foreach($entity->fields as $field)
                    $this->line('- ' . $field->name . ' (' . $field->dataType . ')');
                if(!($this->confirm('Do you want to add field?')))
                    break 1;
               array_push($entity->fields, CommandUtils::fetchField($this));
            }
    
            while($moreRelationships){
                $this->line($entity->modelName . ':');
                foreach($entity->fields as $field)
                    $this->line('- ' . $field->name . ' (' . $field->dataType . ')');
                if(!($this->confirm('Do you want to add relationship to another entity?')))
                    break 1;
               array_push($entity->fields, CommandUtils::fetchRelationship($this));
            }

        }

        if(!$entity->fields || count($entity->fields) === 0){
            $this->error('Entity must have at least one field!');
            return;
        }
        
        // $this->info('Name: ' . $entity->fields[2]->foreignKey->tableName);
        
        $generator = new Generator();
        $this->output->progressStart(10);
        $generator->regenerate($entity);
        $this->output->progressFinish();
        $this->info('Entity ' . $entity->modelName . ' sucesfully regenerated. Check migrations before running them!');
    
    }

}
