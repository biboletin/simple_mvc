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
    private string $viewsDirectory;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->viewsDirectory = __DIR__ . '/../App/Views/';
    }

    /**
     *
     * @param string $viewName
     * @param array<string>   $params
     *
     * @return string
     */
    public function set(string $viewName = 'error', array $params = []): string
    {
        $view = $this->parseView($viewName);
        $data = (object) $params;

        ob_start();
        if (!file_exists($view . '.php')) {
            include $this->viewsDirectory . 'error.php';
        }
        if (file_exists($view . '.php')) {
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
        return $this->viewsDirectory . implode('/', explode('.', $view));
    }

    public function __destruct()
    {
        $this->viewsDirectory = '';
    }
}
