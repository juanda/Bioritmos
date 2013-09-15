<?php

namespace Jazzyweb\Bioritmos\Controller;

use Jazzyweb\Bioritmos\Model\Bioritmos;
use Jazzyweb\Framework\Controller;
use Jazzyweb\Framework\Response;

class DefaultController extends Controller{

    public function index($request){

        $this->setLayout(__DIR__ . '/../Views/layout.php');
        $response = $this->createView(__DIR__ . '/../Views/Default/index.php');

        return $response;
    }

    public function bioritmo($request){

        $fechaNacimiento = $request->get('fechaN');

        $bior = new Bioritmos($fechaNacimiento);
        $bior->DrawBior(__DIR__.'/../../../../web/bioritmos/my_bior.png');

        $this->setLayout(__DIR__ . '/../Views/layout.php');
        $response = $this->createView(__DIR__ . '/../Views/Default/bioritmo.php', array('file' => 'my_bior.png'));

        return $response;
    }

}