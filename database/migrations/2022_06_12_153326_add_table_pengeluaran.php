<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTablePengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pengeluaran", function ($table) {
            $table->id();
            $table->string("id_transaksi");
            $table->string("penanggung_jawab");
            $table->string("tujuan");
            $table->bigInteger("nominal");
            $table->date("tanggal_pengeluaran");
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
        //
    }
}
