<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblXesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_xes', function (Blueprint $table) {
            $table->increments('MaXe');
            $table->string('TenXe');
            $table->string('BienSo');
            $table->string('SoGhe');
            $table->integer('MaLoaiXe')->unsigned();
            $table->foreign('MaLoaiXe')->references('MaLoaiXe')->on('tbl_loaixes')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_xes');
    }
}
