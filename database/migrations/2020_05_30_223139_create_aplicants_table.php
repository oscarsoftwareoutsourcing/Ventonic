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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('oportunity_id');
            $table->foreign('oportunity_id')->references('id')->on('oportunitys')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('status_postulations_id');
            $table->foreign('status_postulations_id')->references('id')->on('status_postulations')->onDelete('restrict')->onUpdate('restrict');
            $table->string('type-message', 255);
            $table->string('message', 255)->nullable();
            // $table->string('estatus', 255);
            $table->boolean('favorite')->nullable();
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
