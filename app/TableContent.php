<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TableContent extends Model
{
    
    public $dataType;
    public $name;
    public $placeholder;
    public $inputType;
    public $isVisible;
    // public $additionalData = array();

    public function __construct($dataType, $name, $placeholder, $inputType, $isVisible){
        $this->dataType = $dataType;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->inputType = $inputType;
        $this->isVisible = $isVisible;
    }
}
