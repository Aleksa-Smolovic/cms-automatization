<?php

namespace Generator;
use Generator\Constants;

class Utils{

    static function sanitaze($input){
        if(trim($input) == '')
            exit('Error');
        return $input;
    }

   static function writeToJson($entity){
        $json = $entity->toJSON();
        $dir = Constants::JSON_DIR;
        if (!file_exists($dir)) 
            mkdir($dir, 0777, true);
        $jsonFile = fopen($dir . $entity->modelName . '.json', 'w');
        fwrite($jsonFile, $json);
        fclose($jsonFile);
    }

    static function findFile($dir, $fileName){
        foreach (glob($dir) as $filefound) {
            if(strpos($filefound, $fileName) !== false)
                return $filefound;
        }
    }

}