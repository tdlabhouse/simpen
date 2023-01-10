<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_po')->nullable();
            $table->string('kd_barang')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('keterangan')->nullable();
            $table->boolean('statusenabled')->nullable();
            $table->timestamps();
        });

        Schema::table('po_detail', function (Blueprint $table) {
            $table->foreign('no_po')->references('no_po')->on('po')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('po_detail');
    }
}
