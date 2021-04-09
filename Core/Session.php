<?php

/**
 * Session handler class
 * for more secure session variables
 *
 * USE
 * Session::start();
 * Session::set(key, value);
 * Session::get(key);
 * Session::del(key);
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
final class Session
{
    private array $session;
    /**
     * Session constructor.
     *
     * Set up private properties
     * Instantiate session
     */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start([
                'save_path' => Config::get('session.save_path'),
                'sid_length' => Config::get('session.sid_length'),
                'trans_sid_hosts' => Config::get('session.trans_sid_hosts'),
            ]);
        }
        /*
        [
                    'save_path' => Config::get('session.save_path'),
                    'sid_length' => Config::get('session.sid_length'),
                    'trans_sid_hosts' => Config::get('session.trans_sid_hosts'),
                ]
        */
        /*
                session_set_cookie_params(
                    Config::get('session.max_life_time'),
                    Config::get('session.path'),
                    Config::get('session.domain'),
                    Config::get('session.secure'),
                    Config::get('session.cookie_httponly')
                );
        */
        $_SESSION = array_map('trim', $_SESSION);
        $_SESSION = array_map('strip_tags', $_SESSION);
        $this->session = $_SESSION;
    }

    /**
     * Adding session element
     *
     * @param null $sessionKey
     * @param null $sessionValue
     *
     * @return string
     */
    public function set($sessionKey = null, $sessionValue = null): string
    {
        if ((empty($sessionKey)) || (empty($sessionValue))) {
            die(__METHOD__ . ' parameters are empty or null!');
        }

        $key = strip_tags(trim(addslashes($sessionKey)));
        $value = strip_tags(trim(addslashes($sessionValue)));

        return $this->session[$key] = $value;
    }

    /**
     * Get session element by key
     *
     * @param string $sessionKey
     *
     * @return string
     */
    public function get(string $sessionKey): string
    {
        $key = strip_tags(trim(stripslashes($sessionKey)));
        return $this->session[$key] ?? '';
    }

    /**
     * @param null $key
     *
     * @return bool
     */
    public function has($key = null): bool
    {
        if (isset($this->session[$key])) {
            return isset($this->session[$key]);
        }
        return false;
    }

    /**
     * Remove session element
     *
     * @param string $sessionKey
     *
     * @return bool
     */
    public function del(string $sessionKey): bool
    {
        $key = strip_tags(trim($sessionKey));
        unset($this->session[$key]);
        return true;
    }

    /**
     * Destroy session
     *
     * @return void
     */
    public function close(): void
    {
        /*
                session_unset();
                session_destroy();
                session_write_close();
                setcookie(session_name(), '', 0, '/');
        */
    }

    public function flash($message)
    {
    }

    public function __destruct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        session_write_close();
        $this->session = [];
    }
}
