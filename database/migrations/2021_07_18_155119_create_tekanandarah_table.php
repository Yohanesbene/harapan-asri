<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTekanandarahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tekanandarah', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawaiid')->nullable();
            $table->integer('penghuniid')->nullable();
            $table->string('systole')->nullable();
            $table->string('diastole')->nullable();
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
        Schema::dropIfExists('tekanandarah');
    }
}
