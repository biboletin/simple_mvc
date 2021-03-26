<?php


namespace Core;

use Core\Session;
use Core\Config;

/**
 * Class Csrf
 *
 * @package Core
 */
class Csrf
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

    /**
     * Validate token
     * @param null $token
     *
     * @return bool
     */
    public static function check($token = null): bool
    {
        return (Session::get('token') === $token);
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
