<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePengeluaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("jenis_pengeluaran",function($table){
            $table->dropColumn("ditujukan");
        });
        Schema::table("pengeluaran",function($table){
            $table->integer("status");
            $table->string("ditujukkan");
            $table->integer("tipe_pengeluaran");
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
