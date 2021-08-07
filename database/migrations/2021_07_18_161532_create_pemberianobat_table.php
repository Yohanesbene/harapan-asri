<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemberianobatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemberianobat', function (Blueprint $table) {
            $table->id();
            $table->integer('pegawaiid')->nullable();
            $table->integer('penghuniid')->nullable();
            $table->string('obatid')->nullable();
            $table->float('dosis', 8, 2)->nullable();
            $table->text('efeksamping')->nullable();
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
        Schema::dropIfExists('pemberianobat');
    }
}
