<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldExpireAtToOportunitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oportunitys', function (Blueprint $table) {
            $table->date('expire_at')->nullable()->comment('Fecha de vencimiento de la oportunidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oportunitys', function (Blueprint $table) {
            $table->dropColumn('expire_at');
        });
    }
}
