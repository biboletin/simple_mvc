<?php

namespace Core;

use Core\Classes\GetRequest;
use Core\Classes\PostRequest;

/**
 * Class Request
 *
 * @package Core
 */
final class Request
{
    /**
     * @var object|GetRequest
     */
    private object $get;
    /**
     * @var object|PostRequest
     */
    private object $post;
    /**
     * @var object|Csrf
     */
    private object $csrf;
    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->post = new PostRequest();
        $this->get = new GetRequest();
        $this->csrf = new Csrf();
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
/*
        $token = null;
        if ($this->post->input('token') !== '') {
            $token = $this->post->input('token');
        }
        if ($token === null || $this->csrf->check($token)) {
            $this->redirect('errors.400', 400);
            return 'Invalid token!';
        }
*/
        return $this->post->input($key);
    }

    /**
     * Get all HTTP values
     *
     * @return array
     */
    public function all(): array
    {
        return array_merge($this->post->all(), $this->get->all());
    }

    /**
     * Get HTTP method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return server('request_method');
    }
    /**
     * Redirect to page/view
     *
     * @param string $page
     * @param int    $code default 200
     */
    public function redirect(string $page, int $code = 200): void
    {
        Redirect::to($page, $code);
    }

    /**
     * Destruct $_GET and $_POST
     */
    public function __destruct()
    {
        unset($this->get);
        unset($this->post);
    }
}
