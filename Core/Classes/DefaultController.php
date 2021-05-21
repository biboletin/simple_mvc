<?php

namespace Core\Classes;

/**
 * Class DefaultController
 *
 * @package Core\Classes
 */
class DefaultController
{
    private string $controllerName;
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

    public function __destruct()
    {
        $this->controllerName = 'Home';
        $this->controllerName = 'index';
    }

    public function getDefaultController(): string
    {
        return ucfirst(strtolower(trim($this->controllerName)));
    }

    public function getDefaultAction(): string
    {
        return $this->action;
    }

    public function getCurrentController(): void
    {
        $url = array_values(
            array_filter(
                explode('/', $this->uri)
            )
        );
    }
}
