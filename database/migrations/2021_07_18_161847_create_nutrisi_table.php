<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutrisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrisi', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawaiid')->nullable();
            $table->integer('penghuniid')->nullable();
            $table->float('keterangan', 8, 2)->nullable();
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
        Schema::dropIfExists('nutrisi');
    }
}
