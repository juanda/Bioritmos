<?php

function asset($asset){
    $preDir = dirname($_SERVER['SCRIPT_NAME']);
    return $preDir. '/' . $asset;
}

function url($ruta){
    $preDir = $_SERVER['SCRIPT_NAME'];

    return $preDir. $ruta;
}

ob_start();
include $template;
$templateContent = ob_get_clean();

ob_start();
include $layout;
$content = ob_get_clean();