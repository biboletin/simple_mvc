<?php
/**
 * Helper functions
 */
use App\Core\Config;


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
function assets($path = '')
{

}