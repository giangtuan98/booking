<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->increments('buses_id');
            $table->string('buses_name');
            $table->time('depart_time');
            $table->time('arrive_time');
            $table->time('duration');
            $table->integer('route_id')->unsigned();
            $table->foreign('route_id')->references('route_id')->on('route')->onDelete('cascade');
            $table->integer('car_id')->unsigned();
            $table->foreign('car_id')->references('car_id')->on('car')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
