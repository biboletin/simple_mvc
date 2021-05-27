<?php

namespace Core\Classes;

use Core\Redirect;
use Core\Request;

/**
 * Class Route
 *
 * @package Core\Classes
 */
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
     * @var object|Request
     */
    protected object $request;
    /**
     * @var string
     */
    protected string $uri;

    /**
     * Route constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->controllerName = (new DefaultController())->getDefaultController();
        $this->actionName = (new DefaultController())->getDefaultAction();
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
        $url = ! empty(trim($this->request->get('url')))
            ? $this->request->get('url')
            : '/';
        $parse = rtrim($url, '/');
        $trimmed = array_map('trim', explode('/', $parse));
        $stripped = array_map('strip_tags', $trimmed);
        $link = $stripped;
        $controller = $this->getController($link);
        $method = $this->getAction($link);
        $param = $this->getParams(implode('/', $link));

        if ($this->getMethod() === 'post') {
            $param = $this->request;
        }

        return [
            'controller' => $controller,
            'method' => $method,
            'params' => $param,
        ];
    }

    /**
     * @param array $url
     *
     * @return string
     */
    protected function getController(array $url): string
    {
        if (empty(array_filter($url))) {
            return $this->suffixController($this->controllerName);
        }
        if (count($url) === 1) {
            return $this->suffixController($this->controllerName);
        }
        return $this->suffixController($url[0]);
    }

    /**
     * @param array $url
     *
     * @return string
     */
    protected function getAction(array $url): string
    {
        if (empty(array_filter($url))) {
            return $this->actionName;
        }
        return trim(strip_tags($url[1]));
    }

    /**
     * Add routes
     *
     * add('/', [Controller::class, 'method'])
     * add('/', function(){ return view('directory.file')})
     * add('/', 'directory.file')
     *
     * @param string $method GET|POST
     * @param string $route {controller}/{method}/{params}
     * @param string|array $callbackAction Class, callback function, string(view)
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
        $param = $this->getParams($path);
        if ($this->getMethod() === 'post') {
            $param = $this->request;
        }

        if ($callback === false) {
            Redirect::to('errors.404', 404);
        }
        if (is_string($callback)) {
            return view($callback);
        }
        if (is_array($callback) && ($this->checkClassExists($callback[0]))) {
            $class = new $callback[0]();
            $method = $callback[1];

            return $class->$method($param);
        }
        echo call_user_func($callback, $param);
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
     * Return url path
     *
     * @return string / or /controller/method/some/params
     */
    protected function getPath(): string
    {
        $path = server('request_uri') ?? '/';
        $position = strpos($path, '?');

        return ($position !== false) ? substr($path, 0, $position) : $path;
    }

    /**
     * Get URI param/s
     *
     * @param string $url
     *
     * @return string
     */
    protected function getParams(string $url): ?string
    {
        $explode = explode('/', $url);
        $param = array_slice($explode, 3) ?? [];
        return array_values($param)[0] ?? '';
    }

    /**
     * Add Controller after controller(first url param) name
     *
     * @param string $controllerName
     *
     * @return string
     */
    protected function suffixController(string $controllerName = ''): string
    {
        return ucfirst(trim($controllerName)) . 'Controller';
    }

    /**
     * Check if class exists
     *
     * @param string $class
     *
     * @return false|string
     */
    protected function checkClassExists(string $class)
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
     *
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
     * Destructor
     */
    public function __destruct()
    {
        $this->controllerName = '';
        $this->actionName = '';
        $this->routes = [];
        unset($this->request);
    }
}
