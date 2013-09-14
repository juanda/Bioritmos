<?php

function loadConfig(){

    $config = array(
        'routes' => array(
            'homepage' => array(
                'path' => '/',
                'controller' => array(
                    'class' => '\Jazzyweb\Bioritmos\Controller\BioritmosController',
                    'action' => 'index'
                )
            ),
            'bioritmo' => array(
                'path' => '/bioritmo',
                'controller' => array(
                    'class' => '\Jazzyweb\Bioritmos\Controller\BioritmosController',
                    'action' => 'bioritmo'
                )
            )
        )

    );
    return $config;
}