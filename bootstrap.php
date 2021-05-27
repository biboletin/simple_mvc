<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
    'driver' => Core\Config::get('mysql.engine'),
    'host' => Core\Config::get('mysql.host'),
    'database' => Core\Config::get('mysql.database'),
    'username' => Core\Config::get('mysql.user'),
    'password' => Core\Config::get('mysql.password')
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();
