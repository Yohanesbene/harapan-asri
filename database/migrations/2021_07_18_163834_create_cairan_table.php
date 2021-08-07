<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCairanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cairan', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawaiid')->nullable();
            $table->integer('penghuniid')->nullable();
            $table->integer('keterangan')->nullable();
            $table->timestamp('waktu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cairan');
    }
}
