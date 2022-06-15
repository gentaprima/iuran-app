<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("tbl_users", function ($table) {
            $table->dropColumn("blok");
            $table->dropColumn("number_family_card");
            $table->dropColumn("number_of_family");
            $table->unsignedBigInteger("id_rumah")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("tbl_users",function($table){
            $table->foreign('id_rumah')->references('id')->on('rumah')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::dropIfExists("tbl_users");
    }
}
