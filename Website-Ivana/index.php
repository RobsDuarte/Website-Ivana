<?php

require __DIR__."/vendor/autoload.php";

use App\Http\Router;

define('URL','http://localhost/projetos/Website-Ivana');

$obRouter = new Router(URL);

include __DIR__."/App/Routes/Pages.php";

$obRouter->run()->sendResponse();
