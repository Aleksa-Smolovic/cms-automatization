<?php

namespace Generator;

class Entity implements \JsonSerializable {

    public $modelName;
    public $tableName;
    public $fields;
    public $timestamp;

    public function __construct($modelName, $tableName, $fields){
        $this->modelName = $modelName;
        $this->tableName = $tableName;
        $this->fields = $fields;
        $this->timestamp = time();
    }

    public function toJSON(){
        return json_encode($this, JSON_PRETTY_PRINT);
    }

    public function jsonSerialize() {
        return [
            'modelName' => $this->modelName,
            'tableName' => $this->tableName,
            'fields' => $this->fields,
            'timestamp' => $this->timestamp
        ];
    }

    public static function fromJSON( $jsonString )
    {
        $object = json_decode($jsonString);
        return new self($object->modelName, $object->tableName, $object->fields);
    }

}