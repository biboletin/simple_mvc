<?php


namespace Core;

use Core\Session;
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

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->bytes = intval(Config::get('security.random_bytes'));
    }

    /**
     * Generates CSRF token
     *
     * @return string
     * @throws Exception
     */
    public function generate(): string
    {
        return $this->session->set('token', bin2hex(random_bytes($this->bytes)));
    }

    /**
     * @return string
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
     * @param null $token
     *
     * @return bool
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
     *
     * @return bool
     */
    public function del(): bool
    {
        return $this->session->del('token');
    }

    public function __destruct()
    {
        unset($this->session);
    }
}
