<?php

namespace Generator;

use \RecursiveIteratorIterator;
use \RecursiveDirectoryIterator;

class RemovalUtils{

    static function deleteFile($file){
        if (file_exists($file)) 
            unlink($file);
    }

    static function removeFolder($dir){
        if (is_dir($dir) === true){
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir), RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($files as $file){
                if (in_array($file->getBasename(), array('.', '..')) !== true){
                    if ($file->isDir() === true){
                        rmdir($file->getPathName());
                    }else if (($file->isFile() === true) || ($file->isLink() === true)){
                        unlink($file->getPathname());
                    }
                }
            }
            return rmdir($dir);
        }else if ((is_file($dir) === true) || (is_link($dir) === true)){
            return unlink($dir);
        }
        return false;
    }

    static function replaceBetween($str, $needleStart, $needleEnd, $replacement) {
        $pos = strpos($str, $needleStart);
        $start = $pos === false ? 0 : $pos + strlen($needleStart);
        $pos = strpos($str, $needleEnd, $start);
        $end = $start === false ? strlen($str) : $pos;
        $needleStartLenght = strlen($needleStart);
        $needleEndLenght = strlen($needleEnd);
        return substr_replace($str, $replacement, $start - $needleStartLenght, ($end - $start) + ($needleEndLenght + $needleStartLenght));
    }

}