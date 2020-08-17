<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldConversionToNegotiationProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negotiation_process', function (Blueprint $table) {
            $table->unsignedSmallInteger('conversion')->default(0)
                  ->comment('Identifica la conversión de la negociación');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('negotiation_process', function (Blueprint $table) {
            $table->dropColumn('conversion');
        });
    }
}
