<?php

namespace Jazzyweb\Framework;

class Request {

    private $request;
    private $files;
    private $server;

    public function __construct($request, $files, $server){
        $this->request = $request;
        $this->files = $files;
        $this->server = $server;
    }

    public function get($name){

        if(!isset($this->request[$name])){
            throw new \Exception('El parámetro ' . $name . ' no se encuentra en la request');
        }

        return $this->request[$name];
    }

    public function getPath(){

        $path = (isset($this->server['PATH_INFO']))? $this->server['PATH_INFO'] : '/';

        return $path;
    }

    public static function createFromGlobals(){

        return new static($_REQUEST, $_FILES, $_SERVER);
    }
}