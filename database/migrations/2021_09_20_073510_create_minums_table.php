<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMinumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minum', function (Blueprint $table) {
            $table->id('minum_id');
            $table->unsignedBigInteger('siklus_id');
            $table->foreign('siklus_id')->references('siklus_id')->on('siklus');
            $table->integer('jumlah_minum');
            $table->date('tanggal');
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
        Schema::dropIfExists('minum');
    }
}
