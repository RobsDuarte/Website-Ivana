<?php

namespace App\Controller;

use App\Utils\View;

class Home{    
    public static function gethome(){
        $home_content = __DIR__.'/../../View/home.html';
        $home_content = file_get_contents($home_content);
        return View::render('template',['content' => $home_content]);
    }    
}