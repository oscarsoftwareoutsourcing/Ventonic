<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->date('tasked_at');
            $table->time('tasked_time');
            $table->char('remember_type')->default('E')->comment('tipo de recordatorio: (E)mail, (S)MS, etc');
            $table->date('remember_at');
            $table->time('remember_time');

            $table->unsignedBigInteger('task_queue_id')->nullable();
            $table->foreign('task_queue_id')->references('id')->on('task_queues')->onDelete('cascade');
            $table->unsignedBigInteger('task_priority_id')->nullable();
            $table->foreign('task_priority_id')->references('id')->on('task_priorities')->onDelete('cascade');
            $table->unsignedBigInteger('task_type_id')->nullable();
            $table->foreign('task_type_id')->references('id')->on('task_types')->onDelete('cascade');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            /** Crea una relación polimorfica */
            $table->nullableMorphs('taskable');
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
        Schema::dropIfExists('tasks');
    }
}
