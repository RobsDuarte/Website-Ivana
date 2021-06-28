<?php

namespace App\Utils;
class View {
    private static function getContentView($view){
        $file = __DIR__.'/../../View/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : "";
    }

    public static function render($view , $vars = []){
        
        if(empty($vars)) return self::getContentView($view);

        $keys = array_keys($vars);
        $keys = array_map(function($element_in_keys){
            return '{{'.$element_in_keys.'}}';
        },$keys);             

        $content = self::getContentView($view);

        return str_replace($keys,array_values($vars) ,$content);
    }
}