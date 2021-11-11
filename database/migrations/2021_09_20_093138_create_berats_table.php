<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berat', function (Blueprint $table) {
            $table->id('berat_id');
            $table->unsignedBigInteger('siklus_id');
            $table->foreign('siklus_id')->references('siklus_id')->on('siklus');
            $table->integer('rata_rata_berat');
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
        Schema::dropIfExists('berat');
    }
}
