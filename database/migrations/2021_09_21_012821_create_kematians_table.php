<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKematiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kematian', function (Blueprint $table) {
            $table->id('kematian_id');
            $table->unsignedBigInteger('siklus_id');
            $table->foreign('siklus_id')->references('siklus_id')->on('siklus');
            $table->date('tanggal');
            $table->integer('jumlah_kematian');
            $table->string('penyebab');
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
        Schema::dropIfExists('kematian');
    }
}
