<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOportunitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oportunitys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('type_oportunity_id');
            $table->foreign('type_oportunity_id')->references('id')->on('type_oportunitys')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('job_type_id');
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('ubication_oportunity_id');
            $table->foreign('ubication_oportunity_id')->references('id')->on('ubication_oportunitys')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('time_zone_id');
            $table->foreign('time_zone_id')->references('id')->on('time_zone_oportunitys')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('profesion_id');
            $table->foreign('profesion_id')->references('id')->on('profesions')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('skill_id')->nullable();;
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('restrict')->onUpdate('restrict');
            $table->string('title', 50)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('habilidades', 255)->nullable();
            $table->string('experience', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->string('estatus', 50)->nullable();;
            $table->date('limit_day', 20)->nullable();;
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
        Schema::dropIfExists('oportunitys');
    }
}
