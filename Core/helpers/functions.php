<?php

/**
 * Helper functions
 */

use Core\Config;
use Core\View;

/**
 * Undocumented function
 */
function config(string $param): string
{
    return Config::get($param);
}

/**
 * Undocumented function
 */
function assets(string $path): string
{
    $url = config('app.url');
    return $url . $path;
}

/**
 * @param array $data
 */
function view(string $view, array $data = []): string
{
    return (new View())->set($view, $data);
}
/**
 * Server variables
 */
function server(string $key): string
{
    return $_SERVER[strtoupper(trim(strip_tags($key)))] ?? '';
}
/**
 * Undocumented function
 */
function route(string $route): string
{
    return config('app.url') . $route;
}
