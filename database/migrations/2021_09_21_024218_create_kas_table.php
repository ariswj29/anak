<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->id('kas_id');
            $table->unsignedBigInteger('siklus_id');
            $table->foreign('siklus_id')->references('siklus_id')->on('siklus');
            $table->date('tanggal');
            $table->string('jenis_transaksi');
            $table->integer('nominal');
            $table->string('kategori');
            $table->string('catatan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kas');
    }
}
