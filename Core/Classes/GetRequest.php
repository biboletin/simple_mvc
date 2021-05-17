<?php

namespace Core\Classes;

use Core\Csrf;
use Core\Session;

final class GetRequest
{
    private array $get;
    private object $csrf;

    public function __construct()
    {
        $this->csrf = new Csrf(new Session());
        header('X-CSRF-Token: ' . $this->csrf->generateXCSRF());
        header('X-XSRF-TOKEN: ' . $this->csrf->generateXXCSRF());

        $this->validate();
    }

    public function validate(): bool
    {
        $this->get = filter_input_array(INPUT_GET, $_GET) ?? [];
        $this->get = array_map('trim', $_GET);
        $this->get = array_map('strip_tags', $_GET);
        return true;
    }

    public function get(string $key): string
    {
        return $this->get[$key] ?? '';
    }

    public function all(): array
    {
        return $this->get;
    }
}
