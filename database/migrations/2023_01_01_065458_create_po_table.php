<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po', function (Blueprint $table) {
            $table->string('no_po', 7)->primary();
            $table->date('tgl_po', 10);
            $table->string('kd_supplier', 5);
            $table->string('no_fpb', 7);
            $table->string('kepada', 30);
            $table->string('note', 200);
            $table->double('ppn', 8);
            $table->timestamps();
        });

        Schema::table('po', function (Blueprint $table) {
            $table->foreign('kd_supplier')->references('kd_supplier')->on('supplier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po');
    }
}
