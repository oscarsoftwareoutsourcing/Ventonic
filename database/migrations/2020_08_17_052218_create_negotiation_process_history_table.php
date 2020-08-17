<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegotiationProcessHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negotiation_process_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('negotiation_process_id')->nullable();
            $table->foreign('negotiation_process_id')->references('id')->on('negotiation_process')->onDelete('cascade');
            $table->unsignedBigInteger('negotiation_id')->nullable();
            $table->foreign('negotiation_id')->references('id')->on('negotiations')->onDelete('cascade');
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
        Schema::dropIfExists('negotiation_process_history');
    }
}
