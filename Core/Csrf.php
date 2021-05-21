<?php

namespace Core;

use Exception;

/**
 * Class Csrf
 *
 * @package Core
 */
final class Csrf
{
    private object $session;
    private int $bytes;

    public function __construct()
    {
        $this->session = new Session();
        $this->bytes = intval(Config::get('security.random_bytes'));
    }

    public function __destruct()
    {
        unset($this->session);
    }

    /**
     * Generates CSRF token
     *
     * @throws Exception
     */
    public function generate(): string
    {
        return $this->session->set('token', bin2hex(random_bytes($this->bytes)));
    }

    /**
     * @throws Exception
     */
    public function generateXCSRF(): string
    {
        return bin2hex(random_bytes($this->bytes));
    }

    /**
     * @throws Exception
     */
    public function generateXXCSRF(): string
    {
        return bin2hex(random_bytes($this->bytes));
    }
    /**
     * Validate token
     *
     * @param null $token
     */
    public function check($token = null): bool
    {
        if ($this->session->get('token') === $token) {
            $this->del();
            return true;
        }
        return false;
    }

    /**
     * Remove/Delete token
     */
    public function del(): void
    {
        $this->session->del('token');
    }
}
