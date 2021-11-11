<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitaminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitamin', function (Blueprint $table) {
            $table->id('vitamin_id');
            $table->unsignedBigInteger('siklus_id');
            $table->foreign('siklus_id')->references('siklus_id')->on('siklus');
            $table->string('jenis_vitamin');
            $table->integer('jumlah_vitamin');
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
        Schema::dropIfExists('vitamin');
    }
}
