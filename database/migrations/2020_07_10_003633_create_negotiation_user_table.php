<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegotiationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negotiation_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('negotiation_id')->unsigned()->notNullable();
            $table->bigInteger('user_id')->unsigned()->notNullable();
            $table->timestamps();

            $table->foreign('negotiation_id')->references('id')->on('negotiations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negotiation_user');
    }
}
