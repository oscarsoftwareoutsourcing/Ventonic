<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilesToOportunitysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oportunitys', function (Blueprint $table) {
            $table->float('amount', 10, 2)->default(0)->comment('Valor del producto servicio importe')->nullable();
            $table->integer('leads')->default(0)->comment('Nro de Leads')->nullable();
            $table->boolean('is_funnel')->default(false)->comment('Embudo de ventas SI  NO')->nullable();
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
            $table->dropColumn('amount');
            $table->dropColumn('leads');
            $table->dropColumn('is_funnel');
        });
    }
}
