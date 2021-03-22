<?php

namespace Core;

use \App\Controllers\HomeController;

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
     * Router constructor.
     */
    public function __construct()
    {
        $this->controllerName = 'Home';
        $this->defaultMethod = 'index';
        $this->params = [];
    }

    /**
     * @return array|false|string[]
     */
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

    /**
     *
     */
    public function run()
    {
//        $url = $this->getUrl();
        $url = !empty(array_filter(explode('/', $_SERVER['REQUEST_URI'])))
                ? array_filter(explode('/', $_SERVER['REQUEST_URI'])) : ['/'];

        if (isset($url[0])) {
            $controller = new HomeController();
            $method = 'index';
        } else {
            $controller = $url[1];
            $this->controllerName = ucfirst($controller);
            unset($url[1]);
            $method = $url[2];
            unset($url[2]);
            $params = $url;
        }

        if (!file_exists(__DIR__ . '/../App/Controllers/' . $this->controllerName . 'Controller.php')) {
            http_response_code(404);
            die('No such controller!');
        }
        if (!method_exists($controller, $method)) {
            http_response_code(404);
            die('No such action!');
        }

        $controller->$method();
    }
}
