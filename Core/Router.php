<?php

namespace Core;

use Core\Classes\DefaultController;
use Core\Classes\ValidateController;
use Core\Classes\ValidateParams;

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
     * @var string
     */
    private string $actionName;
    /**
     * @var array
     */
    private array $routes;
    /**
     * @var object
     */
    private object $request;
    /**
     * @var string
     */
    private string $uri;
    /**
     * @var array
     */
    private array $params;

    // private string $controller;

    /**
     * Router constructor.
     * @param Request $request
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
    private function parseURL(): array
    {
        $url = !empty(trim($this->request->get('url')))
            ? $this->request->get('url')
            : '/';
        $params = $this->request;

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
        }
        if (isset($link[2])) {
            $params = $link[2];
            unset($link[0]);
        }

        $controller = $this->suffixController($this->controllerName);
        $method = $this->actionName;
error_log(print_r([
    'controller' => $controller,
    'method' => $method,
    'params' => $params,
], true));
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
        $controller = 'App\Controllers\\' . $url['controller'];
        $method = $url['method'];
        $params = $url['params'];

        if (!class_exists($controller, true)) {
            Redirect::to('error', 404);
        }
        if (!method_exists($controller, $method)) {
            Redirect::to('error', 404);
        }
        if (strpos($_SERVER['REQUEST_URI'], 'favicon.ico') === false) {
            return (new $controller())->$method($params);
        }
    }

    /**
     * @param string $routeName
     * @param        $callback
     */
    public function get(string $routeName, $callback)
    {
        $this->routes['get'][$routeName] = $callback;
    }

    /**
     * @param string $route
     * @param        $callback
     */
    public function post(string $route, $callback)
    {
        $this->routes['post'][$route] = $callback;
    }

    /**
     *
     */
    public function init()
    {
        $this->resolve();
    }

    /**
     * @return false|mixed|string
     */
    public function resolve()
    {
        $path = $this->getPath();
error_log('PATH: ' . $path);
        $httpMethod = $this->getMethod();
        $callback = $this->routes[$httpMethod][$path] ?? false;
        $params = $this->getParams($path);

        if ($callback === false) {
            Redirect::to('error', 404);
        }
        if (is_string($callback)) {
            return view($callback);
        }
        if (is_array($callback)) {
            $class = new $callback[0]();
            $method = $callback[1];
            return call_user_func_array([$class, $method], $params);
        }

        echo call_user_func($callback, $params);
    }

    public function processPath(string $path)
    {
        return $path;
    }
    /**
     * @return false|string
     */
    public function getPath()
    {
        $path = server('request_uri') ?? '/';
        $position = strpos($path, '?');

        if ($position === false) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    /**
     * @return mixed|string
     */
    public function getParams($url)
    {
        $validator = new ValidateParams();
        $path = $url;
        $explode = explode('/', $path);
// error_log('PARAMS: ' . print_r($explode, true));
        return $explode;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return strtolower(server('request_method'));
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
     * @param $class
     *
     * @return false|string
     */
    private function checkClassExists($class)
    {
        if (class_exists($class)) {
            return $class;
        }
        return false;
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
