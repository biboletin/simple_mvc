<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Core\Router as Router;
use Core\Request as Request;

$router = new Router(new Request());
$router->run();