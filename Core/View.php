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
     * @param string $viewName
     * @param array   $data
     *
     * @return string
     */
    public function set($viewName = '404', $data = null): string
    {
        $view = $this->parseView($viewName);
error_log($view . '.php');
        if (!file_exists($view . '.php')) {
error_log('here 1');
            include $this->viewDirectory . '404.php';
            exit;
        }
error_log('here 2');
        include $view . '.php';
        exit;
    }

    /**
     * @param null $view
     *
     * @return string
     */
    private function parseView($view = null): string
    {
        return $this->viewDirectory . implode('/', explode('.', $view));
    }
}
