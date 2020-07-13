<?php

namespace Generator;
use Generator\Utils;
use Generator\Constants;
use Generator\TableContent;
use Generator\ForeignKeyInstance;
use Illuminate\Support\Str;

class CommandUtils{

    static function fetchField($state){
        $fieldName =  strtolower(Utils::sanitaze($state->ask('Table field name')));
        $fieldDisplayName =  Utils::sanitaze($state->ask('Field display name'));
        $fieldDataType = $state->choice('Field data type', Constants::DATA_TYPES, Constants::DATA_TYPES[0]);
        $fieldInputType = $state->choice('Field input type', Constants::INPUT_TYPES, Constants::INPUT_TYPES[0]);
        $fieldTableVisibility = $state->confirm('Display field in the table?');
        return new TableContent($fieldDataType, $fieldName, $fieldDisplayName, $fieldInputType, $fieldTableVisibility);
    }

    static function fetchRelationship($state){
        $modelName = Utils::sanitaze($state->ask('Other entity model name'));
        if(!file_exists('app/' . $modelName . '.php')){
            $this->error('Model with given name does not exist!');
            exit();
        }
        $className = 'App\\' . Str::studly(Str::singular($modelName));
        if(class_exists($className)) {
            $model = new $className;
        }else{
            $this->error('Model error!');
            exit();
        }
        $tableName = $model->getTable();
        $relationshipName = Utils::sanitaze($state->ask('Foreign key name'));
        $relationshipDisplayName = Utils::sanitaze($state->ask('Foreign key display name'));
        $modelField = $state->ask('Other entity display field');
        $modelField = trim($modelField) == '' || $modelField == 'id' ? 'id' : $modelField;
        $fieldDataType = 'unsignedBigInteger';
        $fieldInputType = 'foreign_key';
        $fieldTableVisibility = $state->confirm('Display field in the table?');
        $relationship = new ForeignKeyInstance($modelName, $tableName, $modelField);
        return new TableContent($fieldDataType, $relationshipName, $relationshipDisplayName, $fieldInputType, $fieldTableVisibility, $relationship);
    }


}