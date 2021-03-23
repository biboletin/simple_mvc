<?php

// https://mabadejedaniel1.medium.com/writing-a-simple-mvc-php-framework-1a576ac66d
//https://github.com/daveh/php-mvc/blob/master/public/index.php
include_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;

$router = new Router();
$router->run();