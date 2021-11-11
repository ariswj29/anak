<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm', function (Blueprint $table) {
            $table->id('farm_id');
            $table->unsignedBigInteger('mitra_id');
            $table->foreign('mitra_id')->references('mitra_id')->on('mitra');
            $table->string('nama_farm');
            $table->string('alamat_farm');
            $table->string('mata_uang');
            $table->string('satuan_berat');
            $table->integer('kapasitas_rak_telur');
            $table->integer('kapasitas_kandang_doc');
            $table->integer('kapasitas_kandang_grower');
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
        Schema::dropIfExists('farm');
    }
}
