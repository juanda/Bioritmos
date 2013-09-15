<?php

namespace Jazzyweb\Framework;


class Controller {

    private $layout;

    public function setLayout($layout){
        if(!file_exists($layout)){
            throw new \Exception('El layout ' . $layout . ' no existe');
        }

        $this->layout = $layout;
    }

    public function createView($template, $params = null ){

        if(!file_exists($template)){
            throw new \Exception('El template ' . $template . ' no existe');
        }

        $layout = $this->layout;
        if(!isset($layout) || !$layout){
            throw new \Exception('Debes definir un layout. Usa setLayout');
        }

        if(isset($params)){
            foreach($params as $key => $value){
                $$key = $value;
            }
        }

        include __DIR__ . '/view.php';

        $response = new Response();

        $response->setContent($contenido);

        return $response;
    }
}