<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Generator\Entity;
use Generator\Constants;
use Generator\Utils;
use Generator\RemovalUtils;

class DeleteEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entity:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete generated entity.';

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
        $this->output->progressStart(10);
        $this->output->progressAdvance();
        $jsonObj = file_get_contents($entityFile);
        $entity = Entity::fromJSON($jsonObj);

        $entityViewsDir = str_replace("_","-", $entity->tableName);
        $this->output->progressAdvance();
        RemovalUtils::removeFolder(Constants::VIEWS_DIR . $entityViewsDir);
        $this->output->progressAdvance();
        RemovalUtils::removeFolder(Constants::CONTROLLERS_DIR . $entity->modelName . 'Controller.php');
        $this->output->progressAdvance();
        RemovalUtils::removeFolder(Constants::REQUESTS_DIR . $entity->modelName . 'Request.php');
        $this->output->progressAdvance();
        RemovalUtils::deleteFile(Utils::findFile(Constants::MIGRATIONS_DIR . '*', 'create_' . $entity->tableName . '_table.php'));
        $this->output->progressAdvance();

        $migrationFile = Constants::MODELS_DIR . $entity->modelName . '.php';
        RemovalUtils::deleteFile($migrationFile);
        $seederFile = Constants::SEEDERS_DIR . $entity->modelName . 'Seeder.php';
        RemovalUtils::deleteFile($seederFile);
        $databaseSeederFile = file_get_contents(Constants::DATABASE_SEEDER);
        $seederNeedle = str_replace('||model||', $entity->modelName, Constants::SEEDER_INSTANCE);
        file_put_contents(Constants::DATABASE_SEEDER, str_replace($seederNeedle, "", $databaseSeederFile));
        $this->output->progressAdvance();

        $sidebarItemsFile = file_get_contents(Constants::SIDEBAR_ITEMS);
        $needleStart = str_replace('||model||', $entity->modelName, Constants::HTML_NEEDLE_START);
        $needleEnd = Constants::HTML_NEEDLE_END;
        $items = RemovalUtils::replaceBetween($sidebarItemsFile, $needleStart, $needleEnd, "");
        file_put_contents(Constants::SIDEBAR_ITEMS, $items);
        $this->output->progressAdvance();

        $routesFile = file_get_contents(Constants::ROUTES_DIR);
        $needleStart = str_replace('||model||', $entity->modelName, Constants::PHP_NEEDLE_START);
        $needleEnd = Constants::PHP_NEEDLE_END;
        $routes = RemovalUtils::replaceBetween($routesFile, $needleStart, $needleEnd, "");
        file_put_contents(Constants::ROUTES_DIR, $routes);
        $this->output->progressAdvance();

        RemovalUtils::deleteFile($entityFile);
        $this->output->progressAdvance();

        $this->output->progressFinish();
        $this->info('Entity ' . $entity->modelName . ' sucesfully deleted.');
    }

}
