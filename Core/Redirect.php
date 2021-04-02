<?php


namespace Core;

use Core\View;

/**
 * Class Redirect
 *
 * @package Core
 */
class Redirect
{
    /**
     * @param null   $page
     * @param int    $code
     * @param string $message
     *
     * @return string View
     */
    public static function to($page = null, $code = 200, $message = ''): string
    {
        http_response_code($code);
        return (new View())->set($page, $message);
    }
}
