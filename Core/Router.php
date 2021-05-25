<?php

namespace Core;

use Core\Classes\Route;

/**
 * Class Router
 *
 * @package Core
 */
final class Router extends Route
{
    /**
     * Set GET Requests
     *
     * get('/', [Controller::class, 'method'])
     * get('/', function(){ return view('directory.file')})
     * get('/', 'directory.file')
     *
     * @param string $routeName
     * @param $callback
     */
    public function get(string $routeName, $callback): void
    {
        $this->add('get', $routeName, $callback);
    }

    /**
     * Set POST Requests
     *
     * @param string $routeName
     * @param        $callback
     */
    public function post(string $routeName, $callback): void
    {
        $this->add('post', $routeName, $callback);
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

        if (! class_exists($controller, true)) {
            Redirect::to('errors.404', 404);
        }
        if (! method_exists($controller, $method)) {
            Redirect::to('errors.404', 404);
        }
        if (strpos(server('request_uri'), 'favicon.ico') === false) {
            return (new $controller())->$method($params);
        }
    }

    /**
     * 1 Replace {variable} with actual url parameter
     * example: /controller/method/{param} => /controller/method/4
     *
     * /controller/method/{param} from defined routes
     *
     * 2 Call Route()->resolve()
     *
     */
    public function init(): void
    {
        $parts = explode('/', $this->getPath());
        $routeFirst = implode('/', array_slice($parts, 1, 2));

        foreach ($this->routes[$this->getMethod()] as $path => $route) {
            $currentKey = $this->routes[$this->getMethod()][$path];
            $part = explode('/', $path);
            $routeSecond = implode('/', array_slice($part, 1, 2));
            $param = $part[3] ?? null;

            if ($routeFirst === $routeSecond && $param !== null) {
                $path = str_replace($param, $parts[3], $path);
            }
            $this->routes[$this->getMethod()][$path] = $currentKey;
        }
        $this->resolve();
    }
}
