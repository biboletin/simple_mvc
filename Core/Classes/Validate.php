<?php

namespace Core\Classes;

final class Validate
{
    private array $patterns = [
        '{name}' => '([a-zA-zа-яА-Я\s]+)',
        '{string}' => '([\w])',
        '{id}' => '(\d+)',
        '{int}' => '(\d+)',
        '{date}' => '(^[0-9]{2}-[0-9]{2}-[0-9]{4})',
        '{slug}' => '([\w\-_]+)',
    ];

    public function __construct()
    {
    }

    public function controller($controller): void
    {
    }
    public function method($method): void
    {
    }
    public function params($params): void
    {
    }

    public function routes($routes): void
    {
    }
}
