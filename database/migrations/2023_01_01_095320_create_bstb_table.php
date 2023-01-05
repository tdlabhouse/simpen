<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBstbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bstb', function (Blueprint $table) {
            $table->string('no_bstb', 7)->primary();
            $table->date('tgl_bstb', 10);
            $table->string('no_fpb', 7);
            $table->string('NmPenerima', 30);
            $table->string('NmMenyerahkan', 30);
            $table->timestamps();
        });

        Schema::table('bstb', function (Blueprint $table) {
            $table->foreign('no_fpb')->references('no_fpb')->on('fpb')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bstb');
    }
}
