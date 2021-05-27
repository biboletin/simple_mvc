<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Users extends Eloquent
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'name',
        'email',
        'password',
    ];
}
