<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFpbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fpb', function (Blueprint $table) {
            $table->string('no_fpb', 7)->primary();
            $table->date('tgl_fpb', 10);
            $table->string('kd_bagian', 5);
            $table->string('pemohon', 20);
            $table->date('tgl_diperlukan', 10);
            $table->string('tujuan', 30);
            $table->timestamps();
        });

        Schema::table('fpb', function (Blueprint $table) {
            $table->foreign('kd_bagian')->references('kd_bagian')->on('bagian')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fpb');
    }
}
