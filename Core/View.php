<?php
namespace Core;

/**
 * Class View
 *
 * @package Core
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
     * @param array   $data
     *
     * @return string
     */
    public function set(string $viewName = 'error', array $data = []): string
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
     * @param string $view
     *
     * @return string
     */
    private function parseView(string $view): string
    {
        return $this->viewDirectory . implode('/', explode('.', $view));
    }

    public function __destruct()
    {
        $this->viewDirectory = '';
    }
}
