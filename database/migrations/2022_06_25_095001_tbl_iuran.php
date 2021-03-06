<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblIuran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_iuran', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaction');
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('to_rekening');
            $table->unsignedBigInteger('id_jenis_iuran');
            $table->integer('sub_total');
            $table->string('month');
            $table->integer('many_months')->nullable();
            $table->string('image')->nullable();
            $table->integer('is_verif');
            $table->integer('is_pay');
            $table->date('date');
            $table->foreign('id_users')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->foreign('to_rekening')->references('id')->on('tbl_rekening')->onDelete('cascade');
            $table->foreign('id_jenis_iuran')->references('id')->on('tbl_jenis_iuran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_iuran');
    }
}
