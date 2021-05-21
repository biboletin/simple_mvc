<?php

/**
 *
 */

namespace Core;

/**
 * Class Config
 *
 * @package app
 */
final class Config
{
    public static function get(?string $search = null): ?string
    {
        $config = include __DIR__ . '/../config.php';
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
