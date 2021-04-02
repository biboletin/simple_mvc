<?php
namespace Core;

/**
 * View class
 */
class View
{
    /**
     * Views base directory
     *
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
     *
     * @param string $viewName
     * @param null   $data
     *
     * @return string
     */
    public function set($viewName = '404', $data = null): string
    {
        $view = $this->parseView($viewName);
        if (!file_exists($view . '.php')) {
            include $this->viewDirectory . 'error.php';
            exit;
        }
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

    public function __destruct()
    {
        $this->viewDirectory = '';
    }
}
