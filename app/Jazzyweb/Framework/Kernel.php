<?php
/**
 * Created by JetBrains PhpStorm.
 * User: juandalibaba
 * Date: 14/09/13
 * Time: 11:26
 * To change this template use File | Settings | File Templates.
 */

namespace Jazzyweb\Framework;


class Kernel {

    private $config;

    public function __construct($config){
        $this->config = $config;
    }

    public static function createFromGlobals(){
        return array(
            'get' => $_GET,
            'post' => $_POST,
            'files' => $_FILES,
            'server' => $_SERVER);
    }
    public function handle($request)
    {
        $router = new Router($this->config['routes']);

        $path = (isset($request['server']['PATH_INFO']))? $request['server']['PATH_INFO'] : '/';

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