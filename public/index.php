<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Core\Request;

$router = new Router(new Request());
$router->run();