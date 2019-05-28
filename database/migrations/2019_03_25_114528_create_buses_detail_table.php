<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusesDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses_detail', function (Blueprint $table) {
            $table->date('buses_departure_date');
            $table->integer('buses_id');
            // $table->foreign('buses_id')->references('buses_id')->on('buses')->onDelete('cascade');
            $table->primary(['buses_departure_date', 'buses_id']);
            $table->integer('available_seats');
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
        Schema::dropIfExists('buses_detail');
    }
}
