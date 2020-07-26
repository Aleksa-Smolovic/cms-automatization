<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Generator\Entity;
use Generator\Constants;
use Generator\Utils;
use Generator\Generator;

class AllEntities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entity:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create multiple entities.';

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
        $fileName = Utils::sanitaze($this->ask('File name'));
        $file = Constants::JSON_DIR . $fileName . '.json';
        if(!file_exists($file)){
            $this->error('File does not exist!');
            return;
        }
        $jsonStr = file_get_contents($file);
        $entities = Entity::fronJSONArray($jsonStr);
        if(count($entities) === 0){
            $this->error('File is empty or malformated!');
            return;
        }

        // TODO validation
        foreach($entities as $entity){     
            if(file_exists('app/' . $entity->modelName . '.php')){
                $this->error('Model already exists!');
                return;
            }       
        }

        $generator = new Generator();
        $this->output->progressStart(count($entities));
        $this->info('Generating entities. This may take a while.');

        foreach($entities as $entity){  
            $generator->generate($entity);
            $this->output->progressAdvance();   
        }

        $this->output->progressFinish();
        $this->info('Entities successfully generated.');
    }
}
