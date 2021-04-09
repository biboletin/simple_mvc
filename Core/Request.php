<?php

namespace Core;

/**
 * Class Request
 *
 * @package Core
 */
final class Request
{
    /**
     * @var array
     */
    private array $get;
    /**
     * @var array
     */
    private array $post;

    /**
     * @var object|Csrf
     */
    private object $csrf;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        if (!empty(array_filter($_GET))) {
            $_GET = array_map('trim', $_GET);
            $_GET = array_map('strip_tags', $_GET);
            $this->get = (array) $_GET;
        }
        if (!empty(array_filter($_POST))) {
            $_POST = array_map('trim', $_POST);
            $_POST = array_map('strip_tags', $_POST);
            $this->post = (array) $_POST;
        }
        $this->csrf = new Csrf(new Session());
        header('X-CSRF-Token: ' . $this->csrf->generateXCSRF());
        header('X-XSRF-TOKEN: ' . $this->csrf->generateXXCSRF());
    }

    /**
     * Get $_GET values
     * Sanitize values
     *
     * @param string $key
     *
     * @return string
     */
    public function get(string $key): string
    {
        return $this->get[trim(strip_tags($key))] ?? '';
    }

    /**
     * Get $_POST values
     * Sanitize values
     *
     * @param string $key
     *
     * @return string
     */
    public function post(string $key): string
    {
        $token = null;
        if (isset($this->post['token'])) {
            $token = $this->post['token'];
        }

        if (($token === null) || ($token === false) || ($this->csrf->check($token))) {
            $this->redirect('error', 400);
            exit;
        }

        return $this->post[trim(strip_tags($key))] ?? '';
    }

    /**
     * Redirect to page/view
     *
     * @param string $page
     * @param int  $code
     */
    public function redirect(string $page, int $code = 200)
    {
        return Redirect::to($page, $code);
    }

    public function __destruct()
    {
        $this->get = [];
        $this->post = [];
    }
}
