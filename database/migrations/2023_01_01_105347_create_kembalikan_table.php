<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKembalikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kembalikan', function (Blueprint $table) {
            $table->string('no_ret', 7);
            $table->string('kd_barang', 5);
            $table->string('jml_ret', 3);
            $table->string('ket_ret', 100);
            $table->timestamps();
        });
        Schema::table('kembalikan', function (Blueprint $table) {
            $table->foreign('no_ret')->references('no_ret')->on('retur')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('kembalikan');
    }
}
