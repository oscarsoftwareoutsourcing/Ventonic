<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('called_at');
            $table->time('called_time');
            $table->longText('description');
            $table->dateTime('follow_task')->nullable()->comment(
                'establece una fecha y hora para recordatorio o tarea'
            );
            $table->unsignedBigInteger('contact_id');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('restrict')->onUpdate('cascade');
            $table->unsignedBigInteger('call_result_id')->nullable();
            $table->foreign('call_result_id')->references('id')->on('call_results')->onDelete('cascade');
            /** Crea una relación polimorfica */
            $table->nullableMorphs('calleventable');
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
        Schema::dropIfExists('call_events');
    }
}
