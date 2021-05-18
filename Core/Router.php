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
     * Router constructor
     * Call parent constructor
     *
     * @param Core\Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
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
            Redirect::to('errors.404', 404);
        }
        if (!method_exists($controller, $method)) {
            Redirect::to('errors.404', 404);
        }
        if (strpos($_SERVER['REQUEST_URI'], 'favicon.ico') === false) {
            return (new $controller())->$method($params);
        }
    }

    /**
     * Set GET Requests
     *
     * @param string $routeName
     * @param        $callback
     */
    public function get(string $routeName, $callback)
    {
        $this->add('get', $routeName, $callback);
    }

    /**
     * Set POST Requests
     *
     * @param string $routeName
     * @param        $callback
     */
    public function post(string $routeName, $callback)
    {
        $this->add('post', $routeName, $callback);
    }

    /**
     *
     */
    public function init()
    {
// error_log(print_r($this->routes, true));
        $this->resolve();
    }
}
