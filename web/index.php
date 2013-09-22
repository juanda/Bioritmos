<?php

include(__DIR__."/../app/autoload.php");

use Jazzyweb\Framework\Kernel;
use Jazzyweb\Framework\Request;

$config = Kernel::loadConfig(__DIR__."/../app/config.php");

$kernel = new Kernel($config);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);

$response->send();