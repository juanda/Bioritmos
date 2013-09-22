<?php

$config = array(
    'routes' => array(
        'homepage' => array(
            'path' => '/',
            'controller' => array(
                'class' => '\Jazzyweb\Bioritmos\Controller\DefaultController',
                'action' => 'index'
            )
        ),
        'bioritmo' => array(
            'path' => '/bioritmo',
            'controller' => array(
                'class' => '\Jazzyweb\Bioritmos\Controller\DefaultController',
                'action' => 'bioritmo'
            )
        )
    )
);