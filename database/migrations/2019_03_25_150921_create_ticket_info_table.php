<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_info', function (Blueprint $table) {
            $table->string('ticket_id', 6);
            $table->primary('ticket_id');
            $table->integer('quantity');
            // $table->date('buses_departure_date');
            // $table->foreign('buses_departure_date')->references('buses_departure_date')->on('buses_detail')->onDelete('cascade');
            $table->integer('buses_id');
            $table->foreign('buses_id')->references('buses_id')->on('buses_detail')->onDelete('cascade');

            // $table->string('passenger_id', 6);
            // $table->foreign('passenger_id')->references('passenger_id')->on('passenger_profile')->onDelete('cascade');
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
        Schema::dropIfExists('ticket_info');
    }
}
