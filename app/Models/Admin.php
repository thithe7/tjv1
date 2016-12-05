<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;

class Admin extends User
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'm_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
