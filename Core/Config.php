<?php
/**
 *
 */
namespace Core;

/**
 * Class Config
 * @package app
 */
class Config
{
    /**
     * @param string|null $search
     * @return string
     */
    public static function get($search = null): String
    {
        $config = include __DIR__ . '/../../config.php';
        $parts = explode('.', $search);

        foreach ($parts as $part) {
            if (isset($config[$part])) {
                $config = $config[$part];
            } else {
                $config = '';
            }
        }
        return $config;
    }
}