<?php
namespace Core;

/**
 * View class
 */
class View
{
    /**
     * @var string
     */
    private string $viewDirectory;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->viewDirectory = __DIR__ . '/../App/Views/';
    }

    /**
     * @param string $view
     * @param null   $data
     */
    public function set($view = 'home', $data = null)
    {
        if (!file_exists($this->viewDirectory . $view . '.php')) {
            include $this->viewDirectory . '404.php';
            exit;
        }
        include $this->viewDirectory . $view . '.php';
        exit;
    }
}
