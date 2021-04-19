<?php

namespace Core;

/**
 * Class Redirect
 *
 * @package Core
 */
class Redirect
{
    /**
     * @param string $page
     * @param int    $code
     */
    public static function to(string $page, int $code = 200): void
    {
        http_response_code($code);
        $view = new View();
        $view->set($page);
    }
}
