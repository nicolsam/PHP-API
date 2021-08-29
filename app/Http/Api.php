<?php

namespace App\Http;

use \App\Models\User;
use \Exception;

class Api {
    private $uri;

    private $service;
    private $serviceNamespace;
    private $method;
    private $params = [];



    public function __construct($uri) {
        $this->uri = $uri;
        $this->load();
    }

    /**
     * Método response por popular a classe
     *
     * @return [type]
     *   [return description]
     */
    private function load() {
        if(!$this->uri) {
            die('Variável url não existe');
        }

        $url = explode('/', $this->uri);

        if(!$url[0] === 'api') {
            die('A URI da API não está sendo corretamente utilizada');
        }

        array_shift($url);
        $this->service = ucfirst($url[0]) . 'Service';
        $this->serviceNamespace = '\App\Services\\' . $this->service;
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);

        array_shift($url);

        if(!empty($url)) {
            $this->params = $url;    
        }
        
    }

    public function run() {
        if(!class_exists($this->serviceNamespace) && method_exists($this->serviceNamespace, $this->method)) {
            echo 'A classe exigida não existe'; exit;
        }

        $data = [
            'status' => 'failed',
            'data' => []
        ];

        try {

            $response = call_user_func_array([new $this->serviceNamespace, $this->method], $this->params);

            if(!$response) {
                throw new Exception("This user doesn't exist!");
                exit;
            }

            foreach($data as $element => &$value) {
                if($element === 'status') {
                    $value = 'success';
                } 
                if($element === 'data') {
                    $value = $response;
                }
            }
            unset($value);

            http_response_code(200);
            return json_encode($data);
            
        } catch(Exception $error) {
            foreach($data as $element => &$value) {
                if($element === 'data') {
                    $value = array($error->getMessage());
                }
            }
            unset($value);

            http_response_code(404);
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }

}