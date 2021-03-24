<?php
/**
 * Helper functions
 */
use Core\Config;
use Core\View;
/**
 * @param null $param
 * @return string
 */
function config($param = null): String
{
    if (($param === null) || ($param === '')) {
        return '';
    }
    return Config::get($param);
}

/**
 * @param string $path
 */
function assets($path = null)
{
    $url = config('app.url');
    return $url . $path;
}

/**
 * @param null $view
 * @param null $data
 *
 * @return mixed
 */
function view($view = null, $data = null)
{
    return (new View())->set($view, $data);
}