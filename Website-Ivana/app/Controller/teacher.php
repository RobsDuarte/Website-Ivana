<?php

namespace App\Controller;

use App\Utils\View;

class Teacher extends Template{    
    public static function getTeacher() {        
        $content =  View::render('professor');
        return self::getTemplate($content);
    }    
}