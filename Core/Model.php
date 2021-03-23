<?php
namespace Core;

/**
 * Model class
 */
class Model
{
    private string $directory;

    public function __construct()
    {
        $this->directory = __DIR__ . '/../App/Models/';
    }
}
