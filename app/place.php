<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class place extends Model
{
    protected $table = "place";
    public $timestamps = false;
    protected $fillable = ['place_id', 'place_name'];
    public function route()
 	   {
 	   		return $this->hasMany('App\route', 'place_id', 'place_id');
 	   }
}
