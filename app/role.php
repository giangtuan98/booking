<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $role = "role";

	public $timestamps = false;
    // 1 role co nhieu user
    public function users()
 	   {
 	   		return $this->hasMany('App\User', 'role_id', 'role_id');
 	   }
}
