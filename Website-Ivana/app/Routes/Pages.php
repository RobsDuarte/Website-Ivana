<?php

use App\Controller\Home;
use App\Controller\Teacher;
use App\Controller\Empresa;
use App\Http\Response;

$obRouter ->get('/',[
    function()
    {
        return new Response(200,Home::getHome());
    }
]);

$obRouter ->get('/Professores',[
    function()
    {
        return new Response(200,Teacher::getTeacher());
    }
]);

$obRouter ->get('/Empresas',[
    function()
    {
        return new Response(200,Empresa::getEmpresa());
    }
]);

$obRouter ->get('/Alunos',[
    function()
    {
        return new Response(200,Home::getHome());
    }
]);