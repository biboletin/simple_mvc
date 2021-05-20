<?php

namespace Core\Classes;

use Core\Classes\DefaultController;
use Core\Request;
use Core\Redirect;

class Route
{
    /**
     * @var string
     */
    protected string $controllerName;
    /**
     * @var string
     */
    protected string $actionName;
    /**
     * @var array
     */
    protected array $routes;
    /**
     * @var object
     */
    protected object $request;
    /**
     * @var string
     */
    protected string $uri;
    /**
     * @var array
     */
    protected array $params;

    // protected string $controller;

    /**
     * Route constructor.
     * @param Core\Request $request
     */
    public function __construct(Request $request)
    {
        $this->controllerName = (new DefaultController())->getDefaultController();
        $this->actionName = (new DefaultController())->getDefaultAction();
        $this->params = [];
        $this->routes = [];
        $this->request = $request;
    }

    /**
     * Parse url params
     *
     * @return array<string>
     */
    protected function parseURL(): array
    {
        $url = !empty(trim($this->request->get('url')))
            ? $this->request->get('url')
            : '/';
        $params = [];

        $parse = rtrim($url, '/');
        $trimmed = array_map('trim', explode('/', $parse));
        $stripped = array_map('strip_tags', $trimmed);
        $link = $stripped;


        if (!isset($link[1]) && !empty($link[0])) {
            $this->actionName = $link[0];
            unset($link[0]);
        }
        if (isset($link[1])) {
            $this->controllerName = $link[0];
            $this->actionName = $link[1];
            unset($link[0]);
            unset($link[1]);
        }
        if (isset($link[2])) {
            $params = array_values($link);
            unset($link[0]);
        }

        $controller = $this->suffixController($this->controllerName);
        $method = $this->actionName;

        return [
            'controller' => $controller,
            'method' => $method,
            'params' => $params,
        ];
    }
    /**
     * Add routes
     *
     * @param string $method GET|POST
     * @param string $route {controller}/{method}/{params}
     * @param string|null $callbackAction Class, callback function, string(view)
     *
     * @return void
     */
    protected function add(string $method, string $route, $callbackAction): void
    {
        $this->routes[strtolower(trim($method))][$route] = $callbackAction;
    }

    /**
     * @return false|mixed|string
     */
    protected function resolve()
    {
        $path = $this->getPath();
        $httpMethod = $this->getMethod();

        $callback = $this->routes[$httpMethod][$path] ?? false;
        $params = $this->getParams($path);

        if ($callback === false) {
            Redirect::to('errors.404', 404);
        }
        //
        if (is_string($callback)) {
            return view($callback);
        }
        if (is_array($callback) && ($this->checkClassExists($callback[0]))) {
            $class = new $callback[0]();
            $method = $callback[1];
            return call_user_func_array([$class, $method], $params);
        }

        echo call_user_func($callback, $params);
    }

    /**
     * Return HTTP method
     * GET|POST
     *
     * @return string
     */
    protected function getMethod(): string
    {
        return strtolower(server('request_method'));
    }

    /**
     * Get URI path
     *
     * @return string
     */
    protected function getPath(): string
    {
        $path = server('request_uri') ?? '/';
        $position = strpos($path, '?');

        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }


    /**
     * Get URI params
     *
     * @param string $url
     * @return void
     */
    protected function getParams($url)
    {
        $parts = explode('/', $this->getPath());
        $routeFirst = implode('/', array_slice($parts, 1, 2));
        
        foreach ($this->routes[$this->getMethod()] as $path => $route) {
            $currentKey = $this->routes[$this->getMethod()][$path];
            $part = explode('/', $path);
            $routeSecond = implode('/', array_slice($part, 1, 2));
            $param = $part[3] ?? null;

            if ($routeFirst === $routeSecond && $param !== null) {
                error_log($this->getPath() . ' === ' . $path);
                $path = str_replace($param, $parts[3], $path);
            }
            $this->routes[$this->getMethod()][$path] = $currentKey;
            return $parts[3];
        }
// error_log(print_r($this->routes, true));
    }

    /**
     * Add Controller after controller(first url param) name
     *
     * @param string $controllerName
     *
     * @return string
     */
    protected function suffixController($controllerName = ''): string
    {
        return ucfirst(trim($controllerName)) . 'Controller';
    }

    /**
     * Check if class exists
     *
     * @param string $class
     * @return mixed
     */
    protected function checkClassExists($class)
    {
        if (class_exists($class)) {
            return $class;
        }
        return false;
    }

    /**
     * Dump routes
     *
     * @param string|null $httpMethod GET, POST
     * @return array
     */
    public function dump(?string $httpMethod = null): array
    {
        if (trim(strtolower($httpMethod)) !== '') {
            return $this->routes[$httpMethod];
        }
        return $this->routes;
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->controllerName = 'Home';
        $this->actionName = 'index';
        $this->params = [];
        $this->routes = [];
        unset($this->request);
    }
}
