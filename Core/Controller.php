<?php
/**
 * Main controller class
 *
 * @namespace Core
 */
namespace Core;

use Core\View;

/**
 * Controller class
 */
class Controller
{
    /**
     * @var object|Core\View
     */
    public object $view;
    /**
     * Controllers base directory
     *
     * @var string
     */
    private string $directory;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->directory = __DIR__ . '/../App/Controllers/';
        $this->view = new View();
    }
}
