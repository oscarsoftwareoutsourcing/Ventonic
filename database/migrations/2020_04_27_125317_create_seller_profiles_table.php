<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country');
            $table->string('phone_code');
            $table->string('phone_mobil');
            $table->string('phone_home')->nullable();
            $table->string('photo')->nullable();
            $table->string('video')->nullable();
            $table->string('linkedin')->nullable();
            $table->float('status')->default(0)->comment('Estatus completado');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('seller_profiles');
    }
}
