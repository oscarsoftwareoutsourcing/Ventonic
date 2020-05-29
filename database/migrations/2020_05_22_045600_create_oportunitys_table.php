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
            // $table->unsignedBigInteger('type_oportunity_id');
            // $table->foreign('type_oportunity_id')->references('id')->on('type_oportunitys')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('job_type_id');
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('ubication_oportunity_id');
            $table->foreign('ubication_oportunity_id')->references('id')->on('ubication_oportunitys')->onDelete('restrict')->onUpdate('restrict');
            // $table->unsignedBigInteger('time_zone_id');
            // $table->foreign('time_zone_id')->references('id')->on('time_zone_oportunitys')->onDelete('restrict')->onUpdate('restrict');
            // $table->unsignedBigInteger('sector_id');
            // $table->foreign('sector_id')->references('id')->on('sector_oportunitys')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('status_id')->nullable();;
            $table->foreign('status_id')->references('id')->on('status_oportunitys')->onDelete('restrict')->onUpdate('restrict');
            $table->string('title', 255);
            $table->longText('description');
            $table->string('cargo',255);
            $table->longText('skills')->nullable();
            $table->longText('functions');
            $table->longText('sectors');
            $table->integer('antiguedad')->nullable();
            $table->string('ubication', 255);
            $table->string('image', 255)->nullable();
            $table->string('email_contact', 255)->nullable();
            $table->string('web', 255)->nullable();
            // $table->date('limit_day')->nullable();;
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
