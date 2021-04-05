<?php


namespace Core;

use Core\Config;
use Core\Session;

/**
 * Class Csrf
 *
 * @package Core
 */
final class Csrf
{
    /**
     * Generates CSRF token
     *
     * @return string
     * @throws \Exception
     */
    public static function generate(): string
    {
        Session::start();
        return Session::set(
            'token',
            bin2hex(random_bytes(Config::get('security.random_bytes')))
        );
    }

    public function generateXCSRF(): string
    {
/*
        Session::start();
        return Session::set(
            'x_csrf_token',
            bin2hex(random_bytes(Config::get('security.random_bytes')))
        );
*/
        return bin2hex(random_bytes(Config::get('security.random_bytes')));
    }

    public function generateXXCSRF(): string
    {
/*
        Session::start();
        return Session::set(
            'x_xsrf_token',
            bin2hex(random_bytes(Config::get('security.random_bytes')))
        );
*/
        return bin2hex(random_bytes(Config::get('security.random_bytes')));
    }
    /**
     * Validate token
     * @param null $token
     *
     * @return bool
     */
    public static function check($token = null): bool
    {
        if ((Session::get('token') === $token)) {
            Session::del('token');
            return true;
        }
        return false;
    }

    /**
     * Remove/Delete token
     *
     * @return void
     */
    public static function del(): void
    {
        Session::start();
        Session::del('token');
    }
}
