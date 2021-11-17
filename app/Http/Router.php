<?php

namespace App\Http;

use \Closure;
use Exception;

class Router
{
    /**
     *URL completa do projeto (raiz)
     * @var string
     */
    private $url = '';

    /**
     * Prefixo de todas as rotas, o que todas rotas tem em comum
     *
     * @var string
     */
    private $prefix = '';

    /**
     *Indice de rotas
     * @var array
     */
    private $routes = [];

    /**
     *Instância de request
     * @var Request
     */
    private $request;

    /**
     *Construtor da classe
     * @param string $url
     */
    public function __construct($url)
    {
        $this->request = new Request();
        $this->url     = $url;
        $this->setPrefix();
        
    }     

    /**
     *Método responsável por definir o prefixo das rotas     
     */
    private function setPrefix()
    {
        $parseUrl = parse_url($this->url) ?? '';
        $this->prefix = $parseUrl['path'];
        
    }
    
    /**
     *Método responsável por adicionar rotas a coleção
     * @param string $method
     * @param string $route
     * @param array $params     
     */
    private function addRoute($method,$route,$params = [])
    {        
         
        foreach($params as $key=>$values)
        {
            if($values instanceof Closure)
            {
                $params['controller'] = $values;                                             
                unset($params[$key]);                               
            }
                
        }
        //PADRÃO DE VALIDAÇÃO DA URL
        $patternRoute = '/^'.str_replace('/','\/',$route).'$/';
        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     *Método responsável por definir uma rota de GET
     * @param string $route
     * @param array $params     
     */
    public function get($route,$params = [])
    {
        return $this->addRoute('GET',$route,$params);
    }
   
    /**
     *Método responsável por definir uma rota de POST
     * @param string $route
     * @param array $params     
     */
    public function post($route,$params = [])
    {
        return $this->addRoute('POST',$route,$params);
    }

    /**
     *Método responsável por definir uma rota de PUT
     * @param string $route
     * @param array $params     
     */
    public function put($route,$params = [])
    {
        return $this->addRoute('PUT',$route,$params);
    }

    /**
     *Método responsável por definir uma rota de DELETE
     * @param string $route
     * @param array $params     
     */
    public function delete($route,$params = [])
    {
        return $this->addRoute('DELETE',$route,$params);
    }

    /**
     * Método responsavel por retornar a uri sem prefixo 
     *
     * @return array
     */
    private function getUri()
    {
        $uri = $this->request->getUri();               
        $explode_uri = strlen($this->prefix) ? explode($this->prefix,$uri) : [$uri];        
        return end($explode_uri);        
    }
    /**
     * Método responsável por retornar os dados da rota atual
     *
     * @return array
     */
    private function getRoute()
    {
        $uri = $this->getUri();        
        $httpMethod = $this->request->getHttpMethod();
        
        foreach($this->routes as $patternRoute=>$methods)
        {
           
            if(preg_match($patternRoute,$uri))
            {
                if($methods[$httpMethod])
                {                                    
                    return $methods[$httpMethod];
                }
                throw new Exception('Método não permitido', 405);
            }            
        }
        throw new Exception('URL não encontrada', 404);
    }
    /**
     * Método responsável por executar a rota atual
     *
     * @return Response
     */
    public function run()
    {
        try
        {
            $route = $this->getRoute();
            
            if(!isset($route['controller']))
            {
                throw new Exception('URL não pode ser processada',500);
            }
            $args = [];
            return call_user_func_array($route['controller'],$args);
        }
        catch(Exception $e)
        {
            return new Response($e->getCode(),$e->getMessage());
        }
    }
}