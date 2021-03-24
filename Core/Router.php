<?php

namespace Core;


/**
 * Router class
 */
class Router
{
    /**
     * @var string
     */
    private string $controllerName;
    /**
     * @var array
     */
    private array $params;
    /**
     * @var string
     */
    private string $defaultMethod;

    /**
     * @var array
     */
    private array $routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->controllerName = 'Home';
        $this->defaultMethod = 'index';
        $this->params = [];
        $this->routes = [];
    }

    /**
     * @param $route
     * @param $action
     */
    public function add($route, $action)
    {
        $this->routes[$route] = $action;
    }

    /**
     * @return array
     */
    private function parseURL(): array
    {
        $url = isset($_GET['url']) ? $_GET['url'] : '/';
        $params = [];
        $parse = rtrim($url, '/');
        $explode = explode('/', $parse);

        if (!isset($explode[1]) && !empty($explode[0])) {
            $this->defaultMethod = $explode[0];
        }

        if (isset($explode[1])) {
            $this->controllerName = $explode[0];
            $this->defaultMethod = $explode[1];
        }

        if (isset($explode[2])) {
            $params = $explode[2];
        }

        $controller = $this->suffixController($this->controllerName);
        $method = $this->defaultMethod;

        return [
            'controller' => $controller,
            'method' => $method,
            'params' => $params,
        ];
    }

    /**
     *
     */
    public function run()
    {
        $url = $this->parseURL();

        if (!empty($url)) {
            $controller = $url['controller'];
            $method = $url['method'];
            $params = $url['params'];

            $controller = 'App\Controllers\\' . $controller;
            if (!method_exists($controller, $method)) {
                http_response_code(404);
                (new View())->set('404', $method . ' not found!');
                exit;
            }
            return (new $controller())->$method($params);

        }
    }

    /**
     *
     */
    public function init()
    {
        //
    }

    /**
     * @param string $controllerName
     *
     * @return string
     */
    private function suffixController($controllerName = ''): string
    {
        return ucfirst(trim($controllerName)) . 'Controller';
    }

    /**
     * @param $controller
     *
     * @return bool
     */
    private function checkController($controller)
    {
        $ctrl = $this->suffixController($controller);
        return (bool) file_exists(__DIR__ . '/../App/Controllers/' . $ctrl . '.php');
    }
}
