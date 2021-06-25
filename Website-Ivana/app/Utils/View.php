<?php

namespace App\Utils;

class View {
    private static function getContentView($view){
        $file = __DIR__.'/../../View/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : "";
    }

    public static function render($view){
        $content = self::getContentView($view);
        return $content;
    }
}