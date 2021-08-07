<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanalatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamanalat', function (Blueprint $table) {
            $table->id();
            $table->integer('peminjam')->nullable();
            $table->integer('penghuniid')->nullable();
            $table->string('jenisalat')->nullable();
            $table->string('ukuran')->nullable();
            $table->timestamp('waktuPinjam');
            $table->integer('pengembali')->nullable();
            $table->timestamp('waktuKembali')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjamanalat');
    }
}
