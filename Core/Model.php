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
class Model extends \MySQLi
{
    /**
     * Models base directory
     */
    private string $directory;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->directory = __DIR__ . '/../App/Models/';
        parent::__construct(
            Config::get('mysql.host'),
            Config::get('mysql.user'),
            Config::get('mysql.password'),
            Config::get('mysql.database'),
            (int) Config::get('mysql.port'),
        );
    }

    public function __destruct()
    {
        $this->directory = '';
        parent::close();
    }
}
