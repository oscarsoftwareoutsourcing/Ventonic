<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('tags');
            $table->enum('category', ['B', 'W', 'P', 'O'])->default('O')->comment(
                'categoría del evento. (B)usiness, (W)ork, (P)ersonal, (O)thers'
            );
            $table->dateTime('start_at')->comment('fecha de inicio del evento')->change();
            $table->dateTime('end_at')->comment('fecha final del evento')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->text('tags')->nullable()->comment('etiquetas bajo la cual se encuentra el evento');
            $table->date('start_at')->comment('fecha de inicio del evento')->change();
            $table->date('end_at')->comment('fecha final del evento')->change();
        });
    }
}
