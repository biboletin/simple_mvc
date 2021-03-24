<?php

namespace Core;

/**
 * Controller class
 */
class Controller
{
    /**
     * @var string
     */
    private string $directory;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->directory = __DIR__ . '/../App/Controllers/';
    }
}
