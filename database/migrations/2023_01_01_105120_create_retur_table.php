<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur', function (Blueprint $table) {
            $table->string('no_ret', 7)->primary();
            $table->date('tgl_ret', 10);
            $table->string('no_do', 7);
            $table->timestamps();
        });

        Schema::table('retur', function (Blueprint $table) {
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
        Schema::dropIfExists('retur');
    }
}
