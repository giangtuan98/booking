<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class route extends Model
{
    protected $table = "route";
    public $timestamps = false;
    protected $fillable = [
        'route_id', 'route_name', 'departure', 'destination', 'duration', 'price'
    ];
    // 1 tuyen co nhieu chuyen xe
    public function buses()
 	   {
 	   		return $this->hasMany('App\buses', 'buses_id', 'buses_id');
 	   }
 	public function place()
 	   {
 	   		return $this->belongsTo('App\place', 'place_id', 'place_id');
 	   }
}
