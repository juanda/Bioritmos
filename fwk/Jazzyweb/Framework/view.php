<?php

function asset($asset){
    $preDir = dirname($_SERVER['SCRIPT_NAME']);
    return $preDir. '/' . $asset;
}

function url($ruta){
    $preDir = $_SERVER['SCRIPT_NAME'];

    return $preDir. $ruta;
}

?>

<?php ob_start() ?>
<?php include $template ?>
<?php $contenidoPlantilla = ob_get_clean() ?>

<?php ob_start() ?>
<?php include $layout ?>
<?php $contenido = ob_get_clean() ?>