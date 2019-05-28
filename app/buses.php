<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class buses extends Model
{
    protected $table = "buses";
    public $timestamps = false;
    protected $fillable = [
        'buses_id', 'buses_name', 'depart_time', 'arrive_time', 'route_id', 'car_id'
    ];
    // 1 chuyen xe thuoc 1 tuyen xe
    public function route()
 	   {
 	   		return $this->belongsTo('App\route', 'route_id', 'route_id');
 	   }
 	   // 1 chuyen xe co 1 xe
 	public function car()
 	   {
 	   		return $this->belongsTo('App\car', 'car_id', 'car_id');
 	   }
 	 	// 1 chuyen xe co nhieu chi tiet chuyen xe
 	public function buses_detail()
 	   {
 	   		return $this->hasMany('App\buses_detail', 'buses_id', 'buses_id');
 	   }
}
