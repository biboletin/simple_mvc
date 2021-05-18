<?php

/**
 * Helper functions
 */

use Core\Config;
use Core\View;

 /**
  * Undocumented function
  *
  * @param string $param
  * @return string
  */
function config(string $param): string
{
    return Config::get($param);
}

/**
 * Undocumented function
 *
 * @param string $path
 * @return string
 */
function assets(string $path): string
{
    $url = config('app.url');
    return $url . $path;
}

/**
 * @param string $view
 * @param array $data
 *
 * @return string
 */
function view(string $view, array $data = []): string
{
    return (new View())->set($view, $data);
}
/**
 * Server variables
 *
 * @param string $key
 * @return string
 */
function server(string $key): string
{
    return $_SERVER[strtoupper(trim(strip_tags($key)))] ?? '';
}
/**
 * Undocumented function
 *
 * @param string $route
 * @return string
 */
function route(string $route): string
{
    return config('app.url') . $route;
}
