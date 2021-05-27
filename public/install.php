<?php

include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../bootstrap.php';
include_once __DIR__ . '/../Database/Migrations/Users.php';

use App\Models\Users;
use Core\Config;

Users::Create([
    'name' => 'bilyan',
    'email' => 'bivanov@brcomp.eu',
    'password' => password_hash('password', Config::get('security.algorithm'), [
        'cost' => Config::get('security.cost')
        ]),
]);
