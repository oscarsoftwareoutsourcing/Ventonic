<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('id')->on('profesions')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('seller_profile_id');
            $table->foreign('seller_profile_id')->references('id')->on('seller_profiles')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('oportunity_id');
            $table->foreign('oportunity_id')->references('id')->on('sector_oportunitys')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('aplicants');
    }
}
