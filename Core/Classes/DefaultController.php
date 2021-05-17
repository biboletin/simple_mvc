<?php

namespace Core\Classes;

/**
 * Class DefaultController
 *
 * @package Core\Classes
 */
class DefaultController
{
    /**
     * @var string
     */
    private string $controllerName;
    /**
     * @var string
     */
    private string $action;

    private string $uri;
    /**
     * DefaultController constructor.
     */
    public function __construct()
    {
        $this->controllerName = 'Home';
        $this->action = 'index';
        $this->uri = server('request_uri');
    }

    /**
     * @param string $controller
     */
    public function setDefaultController(string $controller): void
    {
        $this->controllerName = $controller;
    }

    /**
     * @return string
     */
    public function getDefaultController(): string
    {
        return ucfirst(strtolower(trim($this->controllerName)));
    }

    /**
     * @param string $action
     */
    public function setDefaultAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getDefaultAction(): string
    {
        return $this->action;
    }

    public function getCurrentController()
    {
        $url = array_values(
                array_filter(
                    explode('/', $this->uri)
                )
        );

    }

    /**
     *
     */
    public function __destruct()
    {
        $this->controllerName = 'Home';
        $this->controllerName = 'index';
    }
}
