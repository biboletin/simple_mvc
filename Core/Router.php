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
     * @var object
     */
    private object $request;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->controllerName = 'Home';
        $this->defaultMethod = 'index';
        $this->params = [];
        $this->routes = [];
        $this->request = new Request();
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
     * @return array<string>
     */
    private function parseURL(): array
    {
        $url = $this->request->get('url') ?? '/';
        $params = $this->request;
        $parse = rtrim($url, '/');
        $trimmed = array_map('trim', explode('/', $parse));
        $stripped = array_map('strip_tags', $trimmed);
        $link = $stripped;
//error_log(print_r($link, true));
//error_log(print_r($_SERVER, true));
error_log($this->request->get('url'));
error_log($_SERVER['REQUEST_URI']);
        if (!isset($link[1]) && !empty($link[0])) {
            $this->defaultMethod = $link[0];
            unset($link[0]);
        }
        if (isset($link[1])) {
            $this->controllerName = $link[0];
            $this->defaultMethod = $link[1];
            unset($link[0]);
        }
        if (isset($link[2])) {
            $params = $link[2];
            unset($link[0]);
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
            $controllerName = $url['controller'];
            $namespaceController = 'App\Controllers\\' . $controllerName;
            $controller = $namespaceController;
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
