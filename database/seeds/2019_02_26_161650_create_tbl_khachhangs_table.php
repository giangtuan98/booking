<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblKhachhangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_khachhangs', function (Blueprint $table) {
            $table->increments('MaKH');
            $table->string('TenKH');
            $table->boolean('GioiTinh');
            $table->string('DiaChi');
            $table->string('CMND', 11);
            $table->string('Email');
            $table->string('DienThoai');
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
        Schema::dropIfExists('tbl_khachhangs');
    }
}
