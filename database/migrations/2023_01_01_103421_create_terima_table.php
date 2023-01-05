<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerimaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terima', function (Blueprint $table) {
            $table->string('kd_barang', 5);
            $table->string('no_do', 7);
            $table->integer('jml_terima', 3);
            $table->timestamps();
        });

        Schema::table('terima', function (Blueprint $table) {
            $table->foreign('kd_barang')->references('kd_barang')->on('barang')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('no_do')->references('no_do')->on('do')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terima');
    }
}
