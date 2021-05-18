<?php
// https://github.com/OmarElGabry/miniPHP/tree/master/app/core
// https://gist.github.com/Nilpo/5449999

include_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Core\Request;
use App\Controllers\HomeController;
use App\Controllers\AdminController;


$request = new Request();
$router = new Router($request);
// /*
$router->get('/', [HomeController::class, 'index']);

$router->get('/about', [HomeController::class, 'about']);
$router->get('/contacts', [HomeController::class, 'contacts']);
$router->get('/admin/register', [AdminController::class, 'register']);
$router->get('/admin/login', [AdminController::class, 'login']);
$router->get('/admin/users/{id}', [AdminController::class, 'users']);
// $router->get('/{controller}/{method}/{param}', [AdminController::class, 'users']);

// echo var_dump($router->dump());
$router->init();
// */
// $router->run();
