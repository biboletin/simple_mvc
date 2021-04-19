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
     * @param array<string>   $data
     *
     * @return string
     */
    public function set(string $viewName = 'error', array $data = []): string
    {
        $view = $this->parseView($viewName);
        ob_start();
        if (!file_exists($view . '.php')) {
            include $this->viewDirectory . 'error.php';
        }
        if (file_exists($view . '.php')) {
            extract($data, EXTR_SKIP);
            include $view . '.php';
        }
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
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
