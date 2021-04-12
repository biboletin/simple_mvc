<?php

namespace Core;

use Core\Redirect;

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
     * @param Request $request
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
     *
     * @return void
     */
/*
    public function add($route, $action): void
    {
        $this->routes[$route] = $action;
    }
*/
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
                Redirect::to('error', 404);
            }
            if (!method_exists($controller, $method)) {
                Redirect::to('error', 404);
            }

            if ($method !== 'favicon.ico') {
                return (new $controller())->$method($params);
            }
        }
    }

    /**
     * Initialize routes from DB
     *
     * @return void
     */
/*
    public function init(): void
    {
        //
    }
*/
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
     *
     */
    public function __destruct()
    {
        $this->controllerName = 'Home';
        $this->defaultMethod = 'index';
        $this->params = [];
        $this->routes = [];
        unset($this->request);
    }
}
