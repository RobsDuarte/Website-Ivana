<?php

namespace App\Controller;

use App\Utils\View;

class Empresa extends Template{    
    public static function getEmpresa() {        
        $content =  View::render('empresa');
        return self::getTemplate($content);
    }    
}