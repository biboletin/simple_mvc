<?php
/**
 * Main Model class
 *
 * @namespace Core
 */
namespace Core;

use Core\Config;
/**
 * Model class
 */
class Model extends \MySQLi
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
        parent::__construct(
            Config::get('mysql.host'),
            Config::get('mysql.user'),
            Config::get('mysql.password'),
            Config::get('mysql.database'),
            Config::get('mysql.port'),
        );
    }


}
