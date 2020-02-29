<?php 

namespace App;

use Zizaco\Entrust\EntrustRole;

class userRole extends EntrustRole
{
	protected $fillable = ['user_id', 'role_id'];
	
}