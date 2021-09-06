<?php

namespace App\Http;

class Request
{
    /**
     * Método HTTP da requisição
     *
     * @var string
     */
    private $httpMethod;
    /**
     * URI da pagina
     *
     * @var string
     */
    private $uri;

    /**
     * Parametros da URL recebidos via $_GET
     *
     * @var array
     */
    private $queryParams = [];

    /**
     * Váriaveis recebidas via POST  da página
     *
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho da requisição
     * @var array
     */
    private $headers = [];

    /**
     * Contrustor da classe
     */
    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars    = $_POST ?? [];
        $this->headers     = getallheaders();
        $this->uri         = $_SERVER['REQUEST_URI'] ?? '';
        $this->httpMethod  = $_SERVER['REQUEST_METHOD'] ?? '';
    }          
    /**
     * Método responsavel por retornar o método http da requisição
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }
    /**
     * Método responsável por retornar a uri da página
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }
    /**
     * Método responsável por retornar os headers da requisição
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
    /**
     * Método responsável por retornar os parâmetros da requisição
     * @return array
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }
    /**
     * Método resposável  por retornar os parâmetros pegou por $_POST
     * @return array
     */
    public function getPostVars()
    {
        return $this->postVars;
    }
}