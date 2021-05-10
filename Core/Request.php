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
     * @var array<string>
     */
    private array $get = [];
    /**
     * @var array<string>
     */
    private array $post = [];

    /**
     * @var object|Csrf
     */
    private object $csrf;

    private string $method; // GET, POST
    private string $scheme; // HTTP, HTTPS
    private string $uri; // /controller/action/params
    private string $url; // http(s)://site.com/controller/action/params
    /**
     * Request constructor.
     */
    public function __construct()
    {
        if (!empty(array_filter($_GET))) {
            $_GET = array_map('trim', $_GET);
            $_GET = array_map('strip_tags', $_GET);
            $this->get = $_GET;
        }
        if (!empty(array_filter($_POST))) {
            $_POST = array_map('trim', $_POST);
            $_POST = array_map('strip_tags', $_POST);
            $this->post = $_POST;
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
        if ($token === null || $this->csrf->check($token)) {
            $this->redirect('error', 400);
            return 'Invalid token!';
        }

        return $this->post[trim(strip_tags($key))] ?? '';
    }

    /**
     * Redirect to page/view
     *
     * @param string $page
     * @param int  $code
     *
     * @return void
     */
    public function redirect(string $page, int $code = 200): void
    {
        Redirect::to($page, $code);
    }

    public function __destruct()
    {
        $this->get = [];
        $this->post = [];
    }
}
