<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    public $timestamps    = false;
    protected $primaryKey = 'ORD_IDORDEN';
}
