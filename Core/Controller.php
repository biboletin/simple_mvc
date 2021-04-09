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

    public object $session;
    public object $csrf;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->directory = __DIR__ . '/../App/Controllers/';
        $this->view = new View();
        $this->session = new Session();
        $this->csrf = new Csrf($this->session);
    }

    public function __destruct()
    {
        $this->directory = '';
        unset($this->view);
        unset($this->session);
        unset($this->csrf);
    }
}
