<?php

/**
 * Session handler class
 * for more secure session variables
 *
 * USE
 * Session::start();
 * Session::set(key, value);
 * Sesion::get(key);
 * Sesion::del(key);
 * Session::close();
 *
 * PHP Version 7.2
 *
 * @category Session_Handler
 * @package  Sessions
 * @author   Biboletin <biboletin87@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/biboletin/php
 */

namespace Core;

use Core\Config;

/**
 * Session handler class
 * for more secure session variables
 *
 * @category Session_Handler
 * @package  Sessions
 * @author   Biboletin <biboletin87@gmail.com>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/biboletin/php
 */
class Session
{
    /**
     * Instantiating session handler
     *
     * @var bool
     */
    private static $instance;

    /**
     */

    /**
     * Session constructor.
     *
     * Set up private properties
     * Instantiate session
     */
    private function __construct()
    {
        self::$instance = session_start([
            'save_path' => Config::get('session.save_path'),
            'gc_maxlifetime' => Config::get('session.max_life_time'),
            'sid_length' => Config::get('session.sid_length'),
            'trans_sid_hosts' => Config::get('session.trans_sid_hosts'),
        ]);
    }

    /**
     * Calling Session::start()
     * instead session_start()
     *
     * @return boolean|Session
     */
    public static function start()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Adding session element
     *
     * @param null $sessionKey
     * @param null $sessionValue
     *
     * @return string
     */
    public static function set($sessionKey = null, $sessionValue = null): string
    {
        if (!self::$instance) {
            die("Session is not initialized!");
        }

        if ((empty($sessionKey)) || (empty($sessionValue))) {
            die("Session::set() parameters are empty or null!");
        }

        $key = strip_tags(trim(addslashes($sessionKey)));
        $value = strip_tags(trim(addslashes($sessionValue)));

        return $_SESSION[$key] = $value;
    }

    /**
     * Get session element by key
     *
     * @param null $sessionKey
     *
     * @return mixed
     */
    public static function get($sessionKey = null): string
    {
        if (empty($sessionKey)) {
            die("Session::get() parameter is empty or null!");
        }

        $key = strip_tags(trim(stripslashes($sessionKey)));
        return $_SESSION[$key];
    }

    /**
     * Remove session element
     *
     * @param $sessionKey
     *
     * @return void
     */
    public static function del($sessionKey): void
    {
        if (empty($sessionKey)) {
            die("Session::del() parameter is empty or null!");
        }
        $key = strip_tags(trim($sessionKey));
        unset($_SESSION[$key]);
    }

    /**
     * Destroy session
     *
     * @return void
     */
    public static function close(): void
    {
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name(), '', 0, '/');
        self::$instance = false;
    }
}
