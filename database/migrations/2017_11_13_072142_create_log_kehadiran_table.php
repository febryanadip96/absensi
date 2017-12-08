<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogKehadiranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_kehadiran', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->dateTime('kedatangan');
            $table->dateTime('kepulangan')->nullable();
            $table->integer('daftar_kelas_id')->unsigned();
            $table->foreign('daftar_kelas_id')->references('id')->on('daftar_kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_kehadiran');
    }
}
