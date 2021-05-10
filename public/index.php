<?php
// https://github.com/OmarElGabry/miniPHP/tree/master/app/core
// https://gist.github.com/Nilpo/5449999

include_once __DIR__ . '/../vendor/autoload.php';

use Core\Router;
use Core\Request;
use App\Controllers\HomeController;


$request = new Request();
$router = new Router($request);

$router->get('/', [HomeController::class, 'index']);
// $router->get('/about', [HomeController::class, 'about']);
$router->get('/about', function () {
    return view('site.about');
});
$router->get('/contacts', [HomeController::class, 'contacts']);
$router->post('/contacts', [HomeController::class, 'contacts']);


$router->init();
