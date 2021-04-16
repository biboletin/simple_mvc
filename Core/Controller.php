<?php

/**
 * Main controller class
 *
 * @namespace Core
 */

namespace Core;

/**
 * Controller class
 */
class Controller
{
    /**
     * @var object|View
     */
    public object $view;
    /**
     * Controllers base directory
     *
     * @var string
     */
    private string $directory;

    /**
     * @var object|Session
     */
    public object $session;
    /**
     * @var object|Csrf
     */
    public object $csrf;
    /**
     * @var object|Hash
     */
    public object $hash;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->directory = __DIR__ . '/../App/Controllers/';
        $this->view = new View();
        $this->session = new Session();
        $this->csrf = new Csrf($this->session);
        $this->hash = new Hash();
    }

    /**
     *
     * @return void
     */
    public function redirectToLogin(): void
    {
        Redirect::to('admin/login');
    }

    public function __destruct()
    {
        $this->directory = '';
        unset($this->view);
        unset($this->session);
        unset($this->csrf);
        unset($this->hash);
    }
}
