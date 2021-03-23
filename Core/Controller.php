<?php

namespace Core;

/**
 * Controller class
 */
class Controller
{
    private string $directory;

    public function __construct()
    {
        $this->directory = __DIR__ . '/../App/Controllers/';
    }
}
