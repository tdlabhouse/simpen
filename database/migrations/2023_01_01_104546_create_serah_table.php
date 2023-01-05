<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serah', function (Blueprint $table) {
            $table->string('no_bstb', 7);
            $table->string('kd_barang', 5);
            $table->integer('jlm_serah', 3);
            $table->string('ket_serah', 50);
            $table->timestamps();
        });

        Schema::table('serah', function (Blueprint $table) {
            $table->foreign('no_bstb')->references('no_bstb')->on('bstb')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('serah');
    }
}
