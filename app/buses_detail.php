<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class buses_detail extends Model
{
    protected $table = 'buses_detail';
    public $timestamps = false;
    // 1 chi tiet chuyen xe thuoc ve 1 chuyen xe
    public function buses()
 	   {
 	   		return $this->belongsTo('Aspp\buses', 'buses_id', 'buses_id');
 	   }
 	// 1 chi tiet chuyen xe thuoc ve 1 thong tin ve
 	public function ticket_info()
 	   {
 	   		return $this->belongsTo('App\ticket_info', 'buses_departure_date', 'buses_departure_date');
 	   }
}
