<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteOldNegotiationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('negociation_event');
        Schema::drop('negociation_contact');
        Schema::drop('negociation_note');
        Schema::drop('negociation_type');
        Schema::drop('negociations_company');
        Schema::drop('status_negociations');
        Schema::drop('negociations');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('negociations');
    }
}
