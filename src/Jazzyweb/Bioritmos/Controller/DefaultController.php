<?php

namespace Jazzyweb\Bioritmos\Controller;

use Jazzyweb\Bioritmos\Model\Bioritmos;
use Jazzyweb\Framework\Response;
use Jazzyweb\Framework\Templating;

class DefaultController{

    public function __construct(){
        $this->templating = new Templating();
    }

    public function index($request){

        $templating = new Templating();
        $templating->setLayout(__DIR__ . '/../Views/layout.php');
        $html = $templating->createView(__DIR__ . '/../Views/Default/index.php');

        $response = new Response($html);

        return $response;
    }

    public function bioritmo($request){

        $fechaNacimiento = $request->get('fechaN');

        $bior = new Bioritmos($fechaNacimiento);
        $bior->DrawBior(__DIR__.'/../../../../web/bioritmos/my_bior.png');

        $templating = new Templating();
        $templating->setLayout(__DIR__ . '/../Views/layout.php');
        $html = $templating->createView(__DIR__ . '/../Views/Default/bioritmo.php',
            array('file' => 'bioritmos/my_bior.png'));

        $response = new Response($html);

        return $response;
    }
}