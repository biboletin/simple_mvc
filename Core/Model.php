<?php
namespace Core;

/**
 * Model class
 */
class Model
{
    /**
     * @var string
     */
    private string $directory;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->directory = __DIR__ . '/../App/Models/';
    }
}
