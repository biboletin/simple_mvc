<?php

namespace Core\Classes;

final class PostRequest
{
    private array $post;

    public function __construct()
    {
        $this->validate();
    }

    public function validate(): bool
    {
        $this->post = filter_input_array(INPUT_POST, $_POST) ?? [];
        $this->post = array_map('trim', $_POST);
        $this->post = array_map('strip_tags', $_POST);
        return true;
    }

    public function input(string $key): string
    {
        return $this->post[trim(strip_tags($key))] ?? '';
    }

    public function all(): array
    {
        return $this->post;
    }
}
