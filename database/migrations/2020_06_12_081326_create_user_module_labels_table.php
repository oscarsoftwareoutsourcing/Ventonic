<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserModuleLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_module_labels', function (Blueprint $table) {
            $table->bigIncrements('id');          
            $table->bigInteger('user_id')->unsigned()->comment('Id del usario que crea el grupo');
            $table->bigInteger('module_id')->unsigned()->comment('Id del módulo al que le crearán las etiquetas');
            $table->longText('labels');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('module_id')->references('id')->on('module_labels')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_module_labels');
    }
}
