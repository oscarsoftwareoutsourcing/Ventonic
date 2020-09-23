<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldExternalKeyToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->text('external_key')->nullable()
                  ->comment('Identificador de eventos asociados a un calendario externo');
            $table->string('external_calendar')->nullable()
                  ->comment('texto que identifica al calendario externos. Ej. gCalendar, iCal, outlook, etc');
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
            $table->dropColumn('external_key');
            $table->dropColumn('external_calendar');
        });
    }
}
