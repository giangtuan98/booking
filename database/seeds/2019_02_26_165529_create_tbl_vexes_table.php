<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblVexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_vexes', function (Blueprint $table) {
            $table->increments('MaVe');
            $table->string('TenVe');
            $table->integer('MaKH')->unsigned();
            $table->foreign('MaKH')->references('MaKH')->on('tbl_khachhangs')->onDelete('cascade');
            $table->integer('MaChuyenXe')->unsigned();
            $table->foreign('MaChuyenXe')->references('MaChuyenXe')->on('tbl_chuyenxes')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_vexes');
    }
}
