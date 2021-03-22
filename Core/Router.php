<?php

namespace Core;
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

    private function getUrl()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $trimUrl = rtrim($_SERVER['REQUEST_URI'], '/');
            $filterURL = filter_var($trimUrl, FILTER_SANITIZE_URL);
            return !empty(array_filter(explode('/', $filterURL))) ?
                explode('/', $filterURL) : ['/'];
        }
        return [];
    }

    public function run()
    {
        $url = $this->getUrl();
        if ($url[0] === '/') {

            $controller = (new $this->defaultController);
            $method = $this->defaultMethod;
            error_log("$controller()->$method()");
            return $controller()->$method();
        }
        var_dump($url);


    }
}
