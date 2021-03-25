<?php

namespace Core;


/**
 * Class Router
 *
 * @package Core
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
     * @var array
     */
    private object $request;

    /**
     * Router constructor.
     */
    public function __construct(Request $request)
    {
        $this->controllerName = 'Home';
        $this->defaultMethod = 'index';
        $this->params = [];
        $this->routes = [];
        $this->request = $request;
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
     * Parse url params
     *
     * @return array
     */
    private function parseURL(): array
    {
        $url = $this->request->get('url')
            ? $this->request->get('url')
            : '/';
        $params = $this->request;
        $parse = rtrim($url, '/');
        $trimmed = array_map('trim', explode('/', $parse));
        $stripped = array_map('strip_tags', $trimmed);
        $link = $stripped;

        if (!isset($link[1]) && !empty($link[0])) {
            $this->defaultMethod = $link[0];
        }

        if (isset($link[1])) {
            $this->controllerName = $link[0];
            $this->defaultMethod = $link[1];
        }

        if (isset($link[2])) {
            $params = $link[2];
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
     * Initialize routes without DB
     *
     * @return mixed
     */
    public function run()
    {
        $url = $this->parseURL();

        if (!empty($url)) {
            $controller = $url['controller'];
            $method = $url['method'];
            $params = $url['params'];
            $controller = 'App\Controllers\\' . $controller;

            if (!class_exists($controller, true)) {
                http_response_code(404);
                (new View())->set('404', $controller);
                exit;
            }
            if (!method_exists($controller, $method)) {
                http_response_code(404);
                (new View())->set('404', $method);
                exit;
            }

            return (new $controller())->$method($params);
        }
//?
    }

    /**
     * Initialize routes from DB
     */
    public function init()
    {
        //
    }

    /**
     * Add Controller after controller(first url param) name
     *
     * @param string $controllerName
     *
     * @return string
     */
    private function suffixController($controllerName = ''): string
    {
        return ucfirst(trim($controllerName)) . 'Controller';
    }

    /**
     * Checks if controller exists
     *
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
