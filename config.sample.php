<?php

return [
    /**
     * Application
     */
    'app' => [
        /**
         * Set App name
         */
        'name' => 'App',
        /**
         * Set base url
         */
        'url' => 'http://localhost/',
    ],
    /**
     * MySQL connection
     */
    'mysql' => [
        /**
         * Driver
         * Default mysql
         * mysql for Eloquent
         *
         * mysql
         * mysqli
         * pdo
         */
        'engine' => 'mysql',
        /**
         * Host
         */
        'host' => '127.0.0.1',
        /**
         * Port
         */
        'port' => 3306,
        /**
         * User
         */
        'user' => 'root',
        /**
         * Password
         */
        'password' => '',
        /**
         * Database name
         */
        'database' => 'test',
        /**
         * Collation
         */
        'collation' => '',
        /**
         * Charset
         */
        'charset' => '',
    ],
    /**
     * Session
     */
    'session' => [
        /**
         * Directory to store sessions
         */
        'save_path' => __DIR__ . '/tmp/session',
        /**
         * Session expire after 24h
         *
         */
        'max_life_time' => 86400,
        /**
         * Allows you to specify the length of session ID string.
         * Session ID length can be between 22 to 256.
         * The default is 32.
         */
        'sid_length' => 128,
        /**
         * Specifies which hosts are rewritten to include session id when transparent sid support is enabled.
         * Defaults to $_SERVER['HTTP_HOST']
         */
        'trans_sid_hosts' => $_SERVER['HTTP_HOST'],
        /**
         *
         */
        'cookie_httponly' => 1,
        /**
         *
         */
        'secure' => 1,
        /**
         *
         * Lax
         * Strict
         */
        'same_site' => 'lax',
        /**
         * Domain
         */
        'domain' => 'localhost',
    ],
    /**
     * Security
     */
    'security' => [
        /**
         * Random bytes
         */
        'random_bytes' => 32,
        /**
         *
         */
         'algorithm' => PASSWORD_BCRYPT,
        /**
         *
         */
         'cost' => 12,
    ],
];
