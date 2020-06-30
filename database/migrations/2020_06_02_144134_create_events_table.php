<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('Título del evento');
            $table->date('start_at')->comment('fecha y hora en que inicia el evento');
            $table->date('end_at')->comment('fecha y hora en que finaliza el evento');
            $table->text('notes')->notNullable()->comment('nota o descripción del evento');
            $table->text('tags')->nullable()->comment('etiquetas bajo la cual se encuentra el evento');
            $table->boolean('private')->default(true);
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('events');
    }
}
