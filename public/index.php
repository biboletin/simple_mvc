<?php
//https://github.com/OmarElGabry/miniPHP/tree/master/app/core
include_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Core\Request;

$router = new Router(new Request());
$router->run();
