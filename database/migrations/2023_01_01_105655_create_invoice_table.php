<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->string('no_inv', 7);
            $table->date('tgl_inv', 10);
            $table->string('no_po', 7);
            $table->string('NorevInv', 15);
            $table->double('JmlInv', 8);
            $table->date('tglbayar', 10);
            $table->string('KetInv', 100);
            $table->string('ket_ret', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice');
    }
}
