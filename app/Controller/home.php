<?php

namespace App\Controller;

use App\Utils\View;
class Home extends Template{    
    public static function getHome() {        
        $content =  View::render('home');
        return self::getTemplate($content);
    }    
}