<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('do', function (Blueprint $table) {
            $table->string('no_do', 7)->primary();
            $table->date('tgl_do', 10);
            $table->string('no_po', 7);
            $table->string('NoRefDo', 20);
            $table->timestamps();
        });

        Schema::table('do', function (Blueprint $table) {
            $table->foreign('no_po')->references('no_po')->on('po')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('do');
    }
}
