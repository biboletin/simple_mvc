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
     * @var boolean
     */
    private static bool $instance;

    /**
     * Set up private properties
     * Instantiate session
     */
    private function __construct()
    {
        self::secure();

        if (!empty(Config::get('session.save_path'))) {
            if (!file_exists(Config::get('session.save_path'))) {
                mkdir(Config::get('session.save_path'));
            }
            ini_set('session.save_path', Config::get('session.save_path'));
        }

        if (!empty(Config::get('session.max_life_time'))) {
            ini_set('session.gc_maxlifetime', Config::get('session.max_life_time'));
        }

        self::$instance = session_start();
    }

    /**
     * Calling Session::start()
     * instead session_start()
     *
     * @return boolean
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
     * @return string
     */
    public static function set($sessionKey = null, $sessionValue = null)
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
     * @return string
     */
    public static function get($sessionKey = null)
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
     * @return void
     */
    public static function del($sessionKey)
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
    public static function close()
    {
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name(), '', 0, '/');
        self::$instance = false;
    }

    /**
     * Securing session
     *
     * @return void
     */
    public static function secure()
    {
        ini_set('session.use_only_cookies', '1');

        if (phpversion() < '5.3.0') {
            ini_set('session.hash_function', 1);
        } else {
            ini_set('session.hash_function', 'sha256');
            ini_set('session.hash_bits_per_character', 5);
        }
    }
}