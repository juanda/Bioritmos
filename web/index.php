<?php

include(__DIR__."/../app/config.php");
include(__DIR__."/../app/autoload.php");

use Jazzyweb\Framework\Kernel;

$config = loadConfig();

$kernel = new Kernel($config);
$request = Kernel::createFromGlobals();
$response = $kernel->handle($request);

//print_r($response);
$response->send();