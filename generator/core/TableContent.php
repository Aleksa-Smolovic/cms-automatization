<?php

namespace Generator;

class TableContent implements \JsonSerializable
{
    
    public $dataType;
    public $name;
    public $placeholder;
    public $inputType;
    public $isVisible;
    public $foreignKey;
    // public $additionalData = array();

    public function __construct($dataType, $name, $placeholder, $inputType, $isVisible, $foreignKey = null){
        $this->dataType = $dataType;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->inputType = $inputType;
        $this->isVisible = $isVisible;
        $this->foreignKey = $foreignKey;
    }

    public function jsonSerialize() {
        return [
            'dataType' => $this->dataType,
            'name' => $this->name,
            'placeholder' => $this->placeholder,
            'inputType' => $this->inputType,
            'isVisible' => $this->isVisible,
            'foreignKey' => $this->foreignKey,
        ];
    }

}
