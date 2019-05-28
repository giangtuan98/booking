<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblChuyenxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_chuyenxes', function (Blueprint $table) {
            $table->increments('MaChuyenXe');
            $table->string('TenChuyenXe');
            $table->integer('MaTuyen')->unsigned();
            $table->foreign('MaTuyen')->references('MaTuyen')->on('tbl_tuyenxes')->onDelete('cascade');
            $table->time('GioXuatPhat');
            $table->time('GioDen');
            $table->integer('SoGheTrong');
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
        Schema::dropIfExists('tbl_chuyenxes');
    }
}
