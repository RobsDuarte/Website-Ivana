<?php

namespace App\Controller;

use App\Utils\View;
class Home extends Template{    
    public static function getHome() {
        $home_content = __DIR__.'/../../View/home.html';
        $home_content = file_get_contents($home_content);
        $content =  View::render('home');
        return self::getTemplate($content);
    }    
}