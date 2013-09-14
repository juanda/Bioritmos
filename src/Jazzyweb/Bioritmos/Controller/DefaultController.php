<?php

namespace Jazzyweb\Bioritmos\Controller;

use Jazzyweb\Framework\Response;

class Controller {

    public function index($request){

        $response = new Response();

        $response->setContent('<html><body><h1>Index</h1></body></html>');

        return $response;
    }

    public function bioritmo($request){

        $response = new Response();

        $response->setContent('<html><body><h1>Bioritmo</h1></body></html>');

        return $response;
    }

}