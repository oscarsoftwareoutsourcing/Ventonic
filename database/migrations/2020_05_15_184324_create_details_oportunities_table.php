<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsOportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_oportunities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_oportunity_id');
            $table->foreign('type_oportunity_id')->references('id')->on('types_oportunitys')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('oportunity_id');
            $table->foreign('oportunity_id')->references('id')->on('oportunities')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('jobt_type_id');
            $table->foreign('jobt_type_id')->references('id')->on('job_types')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('sector_id');
            $table->foreign('sector_id')->references('id')->on('sectors_oportunities')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('ubication_oportunity_id');
            $table->foreign('ubication_oportunity_id')->references('id')->on('ubications_oportunities')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('time_zone_id');
            $table->foreign('time_zone_id')->references('id')->on('time_zone_oportunities')->onDelete('restrict')->onUpdate('restrict');
            $table->string('title', 255)->nullable();
            $table->string('experience', 255)->nullable();
            $table->string('image', 255)->nullable();
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
        Schema::dropIfExists('details_oportunities');
    }
}
