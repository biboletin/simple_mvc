<?php

namespace Core;

/**
 * Class Redirect
 *
 * @package Core
 */
final class Redirect
{
    /**
     * Redirect to page with http status
     *
     * @param string $page
     * @param integer $code default 200
     *
     * @return void
     */
    public static function to(string $page, int $code = 200): void
    {
        http_response_code($code);
        $view = new View();
        $view->set($page);
    }
}
