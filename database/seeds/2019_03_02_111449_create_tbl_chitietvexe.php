<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblChitietvexe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_chitietvexes', function (Blueprint $table) {
            $table->increments('MaCTVX');
            $table->integer('MaVe')->unsigned();
            $table->foreign('MaVe')->references('MaVe')->on('tbl_vexes')->onDelete('cascade');
            $table->integer('MaXe')->unsigned();
            $table->foreign('MaXe')->references('MaXe')->on('tbl_xes')->onDelete('cascade');
            $table->integer('ViTriGhe');
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
        Schema::dropIfExists('tbl_chitietvexe');
    }
}
