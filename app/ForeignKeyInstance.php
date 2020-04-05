<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForeignKeyInstance extends Model
{
    public $modelName;
    public $tableName;
    public $displayField;

    public function __construct($modelName, $tableName, $displayField){
        $this->modelName = $modelName;
        $this->tableName = $tableName;
        $this->displayField = $displayField;
    }
}
