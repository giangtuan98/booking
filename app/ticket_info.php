<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticket_info extends Model
{
    protected $table = "ticket_info";

	public $timestamps = false;
    // 1 ve xe dat duoc 1 chuyen xe voi nhieu so luong
    public function buses_detail()
 	   {
 	   		return $this->belongsTo('App\buses_detail', 'buses_departure_date', 'buses_departure_date');
 	   }
 	
 	// 1 ve thuoc ve 1 hanh khach
 	public function passenger_profile()
 	   {
 	   		return $this->belongsTo('App\passenger_profile', 'passenger_id', 'passenger_id');
 	   }
}
