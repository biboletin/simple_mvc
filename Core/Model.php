<?php
/**
 * Main Model class
 *
 * @namespace Core
 */
namespace Core;

/**
 * Model class
 */
class Model
{
    /**
     * Models base directory
     *
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
