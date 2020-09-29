<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAppTypeFieldToCalendarSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calendar_settings', function (Blueprint $table) {
            $table->string('appType', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calendar_settings', function (Blueprint $table) {
            $table->enum('appType', ['gCalendar', 'outlook', 'iCal', 'other'])->default('gCalendar')->comment(
                'Tipo de aplicación a configurar. Ejemplo: Google Calendar, Outlook Calendar, iCal, etc.'
            );
        });
    }
}
