<?php
/**
 * Created by JetBrains PhpStorm.
 * User: juandalibaba
 * Date: 14/09/13
 * Time: 12:07
 * To change this template use File | Settings | File Templates.
 */

namespace Jazzyweb\Framework;


class Router {

    private $routes;

    public function __construct($routes){

        $this->routes = $routes;
    }

    public function getController($path){

        foreach($this->routes as $route){
            if($path === $route['path']){
                if(!method_exists($route['controller']['class'],$route['controller']['action'])){
                    throw new \Exception('El controlador '
                    . $route['controller']['class']
                    . ':' . $route['controller']['action']
                    . ' no existe');
                }

                return $route['controller'];
            }
        }
        throw new \Exception('La ruta ' . $path . ' no existe');
    }
}