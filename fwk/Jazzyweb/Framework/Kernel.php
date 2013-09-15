<?php

namespace Jazzyweb\Framework;


class Kernel {

    private $config;

    public function __construct($config){
        $this->config = $config;
    }

    public function handle($request)
    {
        $router = new Router($this->config['routes']);

        $path = $request->getPath();

        $controlador = $router->getController($path);

        $response = $this->buildResponse($controlador, $request);

        return $response;
    }

    private function buildResponse($controlador, $request){

        return call_user_func(array(
            new $controlador['class'],
            $controlador['action']), $request);
    }
}