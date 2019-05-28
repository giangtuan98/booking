<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class passenger_profile extends Model
{
    protected $table = "passenger_profile";
    public $timestamps = false;
// 1 hang khach co 1 nhieu ve
    public function ticket_info()
 	   {
 	   		return $this->hasMany('App\ticket_info', 'passenger_id', 'passenger_id');
 	   }

}
