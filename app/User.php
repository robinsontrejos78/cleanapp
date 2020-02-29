<?php

namespace App;

use Zizaco\Entrust\Traits\EntrustUserTrait;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    use EntrustUserTrait;
    
    protected $fillable = [
        'name', 'email', 'password', 'USR_APELLIDOS', 'USR_DOCUMENTO', 'USR_TELEFONO', 'USR_ESTADO','USR_direccion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
