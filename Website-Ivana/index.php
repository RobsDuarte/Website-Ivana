<?php

require __DIR__."/vendor/autoload.php";

use App\Http\Router;
use App\Utils\View;

define('URL','http://localhost/projetos/Website-Ivana');

//Define o valor padrão das variaveis
View::init([
    'URL' =>  URL
]);

//incia o router
$obRouter = new Router(URL);

// inclue as rotas das páginas
include __DIR__."/App/Routes/Pages.php";

//imprime a resposta do servidor
$obRouter->run()->sendResponse();
