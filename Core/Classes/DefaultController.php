<?php

namespace Core\Classes;

class DefaultController
{
    private string $controllerName;
    
    public function __construct()
    {
        $this->controllerName = 'Home';
    }
    
    public function setDefaultController(string $controller)
    {
        $this->controllerName = $controller;
    }
    public function getDefaultController(): string
    {
        return ucfirst(strtolower(trim($this->controllerName)));
    }
    
    public function __destruct()
    {
        $this->controllerName = 'Home';
    }
}
