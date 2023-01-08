<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKdbrgOnTblFpb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('fpb', function (Blueprint $table) {
            $table->string('kd_barang', 5);
        });
        Schema::table('fpb', function (Blueprint $table) {
            $table->foreign('kd_barang')->references('kd_barang')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
