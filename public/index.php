<?php
// https://github.com/OmarElGabry/miniPHP/tree/master/app/core
// https://gist.github.com/Nilpo/5449999
include_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Core\Request;

$router = new Router(new Request());
$router->run();
