<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Core\Request;
use Core\Session;

Session::start();
Session::set('user', 'test');
echo Session::get('user');
$router = new Router(new Request());
$router->run();