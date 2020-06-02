<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociationsCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negociations_company', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');

            $table->unsignedBigInteger('seller_profile_id');
            $table->foreign('seller_profile_id')->references('id')->on('seller_profiles')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('status_negociations_id');
            $table->foreign('status_negociations_id')->references('id')->on('status_negociations')->onDelete('restrict')->onUpdate('restrict');
            $table->string('producto', 255);
            $table->string('responsable', 255);
            $table->float('importe', 8, 2);
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
        Schema::dropIfExists('negociations_company');
    }
}
