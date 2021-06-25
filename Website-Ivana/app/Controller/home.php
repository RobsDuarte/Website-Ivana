<?php

namespace App\Controller;

use App\Utils\View;

class Home{    
    public static function gethome(){
        return View::render('template');
    }    
}