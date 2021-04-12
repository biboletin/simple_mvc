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
        $port = (int) Config::get('mysql.port');
        parent::__construct(
            Config::get('mysql.host'),
            Config::get('mysql.user'),
            Config::get('mysql.password'),
            Config::get('mysql.database'),
            $port,
        );
    }

    public function __destruct()
    {
        $this->directory = '';
        parent::close();
    }
}
