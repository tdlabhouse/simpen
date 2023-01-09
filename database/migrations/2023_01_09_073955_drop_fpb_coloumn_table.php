<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropFpbColoumnTable extends Migration
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
            $table->dropForeign(['kd_barang']);
        });

        Schema::table('fpb', function (Blueprint $table) {
            $table->dropColumn(['kd_barang', 'keterangan', 'jumlah']);
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
