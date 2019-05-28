<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class car extends Model
{
    protected $table = "car";
    public $timestamps = false;
    // 1 xe thuoc ve 1 tuyen
    public function buses()
 	   {
 	   		return $this->belongsTo('App\buses', 'car_id', 'car_id');
 	   }
}
