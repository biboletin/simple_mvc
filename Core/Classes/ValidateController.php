<?php

namespace Core\Classes;

class ValidateController
{
    private string $controllerName;

    public function __construct()
    {
    }

    public function controllerExists(string $controllerName): bool
    {
        return file_exists(__DIR__ . '');
    }

    public function extractControllerName(string $controller): string
    {

    }
}
