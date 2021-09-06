<?php

namespace App\Controller;

use App\Utils\View;

class Template{    
    public static function getTemplate($content){        
        return View::render('template',['content' => $content]);
    }    
}