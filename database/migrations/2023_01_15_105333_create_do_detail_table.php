<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('do_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_do')->nullable();
            $table->string('kd_barang')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('keterangan')->nullable();
            $table->boolean('statusenabled')->nullable();
            $table->timestamps();
        });

        Schema::table('do_detail', function (Blueprint $table) {
            $table->foreign('no_do')->references('no_do')->on('do')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kd_barang')->references('kd_barang')->on('barang')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('do_detail');
    }
}
