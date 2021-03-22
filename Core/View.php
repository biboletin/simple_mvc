<?php
namespace Core;

/**
 * View class
 */
class View
{
    private string $viewDirectory;

    public function __construct()
    {
        $this->viewDirectory = __DIR__ . '/../App/Views/';
    }

    public function set($view = 'home')
    {
        if (!file_exists($this->viewDirectory . $view . '.php')) {
            include $this->viewDirectory . '404.php';
            exit;
        }
        include $this->viewDirectory . $view . '.php';
        exit;
    }
}
