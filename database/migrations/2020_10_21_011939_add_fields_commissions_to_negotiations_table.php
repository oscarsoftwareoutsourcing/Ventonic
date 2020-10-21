<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsCommissionsToNegotiationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('negotiations', function (Blueprint $table) {
            $table->enum('commission_type', ['P', 'M'])->default('M')->comment(
                'Tipo de comisión a aplicar. Ej. (P)orcentaje, (M)onto'
            );
            $table->double('commission_amount', 8, 2)->default(0)->comment('Monto de la comisión');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('negotiations', function (Blueprint $table) {
            $table->dropColumn('commission_type');
            $table->dropColumn('commission_amount');
        });
    }
}
