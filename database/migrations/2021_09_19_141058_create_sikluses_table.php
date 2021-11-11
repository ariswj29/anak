<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiklusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siklus', function (Blueprint $table) {
            $table->id('siklus_id');
            $table->unsignedBigInteger('farm_id');
            $table->foreign('farm_id')->references('farm_id')->on('farm');
            $table->string('nama_siklus');
            $table->date('tanggal');
            $table->string('jenis_ternak');
            $table->integer('jumlah_ternak');
            $table->integer('harga_satuan_doc');
            $table->string('supplier');
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
        Schema::dropIfExists('siklus');
    }
}
