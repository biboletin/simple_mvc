<?php

namespace Core;

use Core\Classes\PostRequest;
use Core\Classes\GetRequest;

/**
 * Class Request
 *
 * @package Core
 */
final class Request
{
    /**
     * @var object
     */
    private object $get;
    /**
     * @var object
     */
    private object $post;

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
        $this->post = new PostRequest();
        $this->get = new GetRequest();
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
        return $this->get->get($key);
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
        if ($this->post->input('token') !== '') {
            $token = $this->post->input('token');
        }
        if ($token === null || $this->csrf->check($token)) {
            $this->redirect('error', 400);
            return 'Invalid token!';
        }

        return $this->post->input($key);
    }

    public function all()
    {
        return array_merge($this->post->all(), $this->get->all());
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
        unset($this->get);
        unset($this->post);
    }
}
