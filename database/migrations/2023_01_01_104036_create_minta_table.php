<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMintaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('minta', function (Blueprint $table) {
            $table->string('no_fpb', 7);
            $table->string('kd_barang', 5);
            $table->string('jml_minta', 3);
            $table->string('keterangan', 50);
            $table->timestamps();
        });

        Schema::table('minta', function (Blueprint $table) {
            $table->foreign('no_fpb')->references('no_fpb')->on('fpb')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('kd_barang')->references('kd_barang')->on('barang')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('minta');
    }
}
