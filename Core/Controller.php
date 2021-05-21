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
    protected object $view;
    /**
     * Controllers base directory
     */
    protected string $directory;

    /**
     * @var object|Session
     */
    protected object $session;
    /**
     * @var object|Csrf
     */
    protected object $csrf;
    /**
     * @var object|Hash
     */
    protected object $hash;

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

    public function __destruct()
    {
        $this->directory = '';
        unset($this->view);
        unset($this->session);
        unset($this->csrf);
        unset($this->hash);
    }

    public function redirectToLogin(): void
    {
        Redirect::to('admin/login');
    }
}
