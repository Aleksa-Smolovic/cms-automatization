<?php

namespace Generator;

class ForeignKeyInstance implements \JsonSerializable
{
    public $modelName;
    public $tableName;
    public $displayField;

    public function __construct($modelName, $tableName, $displayField){
        $this->modelName = $modelName;
        $this->tableName = $tableName;
        $this->displayField = $displayField;
    }

    public function jsonSerialize() {
        return [
            'modelName' => $this->modelName,
            'tableName' => $this->tableName,
            'displayField' => $this->displayField
        ];
    }

}
