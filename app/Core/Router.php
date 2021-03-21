<?php

namespace App\Core;

/**
 * Router class
 */
class Router
{
    private $defaultController;
    private $defaultMethod;
    private $params;

    public function __construct()
    {
        $this->defaultController = 'HomeController';
        $this->defaultMethod = 'index';
        $this->params = [];
    }


    public function run()
    {
        $trimUrl = rtrim($_SERVER['REQUEST_URI'], '/');
        $filterUrl = filter_var($trimUrl, FILTER_SANITIZE_URL);

        if (!empty(array_filter(explode('/', $filterUrl)))) {
//            $this->defaultController =;
//            $this
        }

        $controller = new $this->defaultController;
        $method = $this->defaultMethod;
error_log(123);
    }
}
