<?php
/**
 *
 */
namespace App\Core;

/**
 * Class Config
 * @package App
 */
class Config
{
    /**
     * @param string|null $search
     * @return string
     */
    public static function get($search = null)
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
