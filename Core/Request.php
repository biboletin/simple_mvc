<?php
namespace Core;

use Core\Csrf;

/**
 * Class Request
 *
 * @package Core
 */
final class Request
{
    /**
     * @var array|mixed
     */
    private array $get;
    /**
     * @var array|mixed
     */
    private array $post;

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

        header('X-CSRF-Token: ' . Csrf::generateXCSRF());
        header('X-XSRF-TOKEN: ' . Csrf::generateXXCSRF());
    }

    /**
     * Get $_GET values
     * Sanitize values
     *
     * @param null $key
     *
     * @return mixed|string
     */
    public function get($key = null): string
    {
        return isset($this->get[trim(strip_tags($key))])
            ? $this->get[trim(strip_tags($key))]
            : '';
    }

    /**
     * Get $_POST values
     * Sanitize values
     *
     * @param null $key
     *
     * @return mixed|string
     */
    public function post($key = null): string
    {
/*
        $requestToken = isset($this->post['token']) ?: false;

        if (!isset($this->post['token'])) {
            $this->redirect('error');
        }
        if (isset($requestToken) && (Csrf::check($requestToken) === false)) {
            $this->redirect('error');
            die('Invalid request!');
        }
*/
        $token = null;
        if (isset($this->post['token'])) {
            $token = $this->post['token'];
        }
error_log($token);
        if (($token === null) || ($token === false)) {
error_log('redirected');
            $this->redirect('error');
        }
error_log('not redirected');
        return isset($this->post[trim(strip_tags($key))])
            ? $this->post[trim(strip_tags($key))]
            : '';
    }

    /**
     * Redirect to page/view
     *
     * @param null $page
     * @param int  $code
     */
    public function redirect($page = null, $code = 200)
    {
        $url = Config::get('app.url') . $page;
        header('Location: ' . $url, $code);
        exit;
    }

    public function __destruct()
    {
        $this->get = [];
        $this->post = [];
    }
}
