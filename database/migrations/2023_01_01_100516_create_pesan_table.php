<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->string('no_po', 7);
            $table->string('kd_barang', 5);
            $table->string('qty', 3);
            $table->double('harga_pesan', 8);
            $table->timestamps();
        });

        Schema::table('pesan', function (Blueprint $table) {
            $table->foreign('no_po')->references('no_po')->on('po')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('pesan');
    }
}
