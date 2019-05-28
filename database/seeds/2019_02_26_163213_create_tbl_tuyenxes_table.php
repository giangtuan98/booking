<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTuyenxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tuyenxes', function (Blueprint $table) {
            $table->increments('MaTuyen');
            $table->string('TenTuyen');
            $table->string('DiemDi');
            $table->string('DiemDen');
            $table->integer('Gia');
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
        Schema::dropIfExists('tbl_tuyenxes');
    }
}
