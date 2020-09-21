<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('appType', ['gCalendar', 'outlook', 'iCal', 'other'])->default('gCalendar')->comment(
                'Tipo de aplicación a configurar. Ejemplo: Google Calendar, Outlook Calendar, iCal, etc.'
            );
            $table->text('credentials')->nullable()->comment(
                'Ruta en donde se encuentra el archivo de credenciales si el cliente del calendario asi lo requiere'
            );
            $table->text('api_key')->nullable()->comment(
                'Clave de la API si el cliente del calendario asi lo requiere'
            );
            $table->text('secret_key')->nullable()->comment(
                'Clave secreta de la API si el cliente del calendario asi lo requiere'
            );
            $table->text('token')->nullable()->comment(
                'Token del API si el cliente del calendario asi lo requiere'
            );
            $table->text('calendar_key')->nullable()->comment(
                'Identificador del calendario suministrado por la API a configurar, ' .
                'normalmente con el nombre CALENDAR_ID'
            );
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('calendar_settings');
    }
}
