<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mailable');
            $table->string('name')->comment('Nombre con el cual se va a identificar la plantilla');
            $table->text('module_class')->nullable()->comment('Clase a la cual se va a asociar la plantilla');
            $table->text('module_name')->nullable()
                  ->comment(
                      'Nombre del módulo. Ej: app (se refiere a las plantillas del núcleo de la aplicación),
                      oportunidades, contactos'
                  );
            $table->enum('type', ['C', 'N', 'E', 'O'])->default('N')
                  ->comment('Define el tipo de la plantilla. Ej. (C)ampaña, (N)otificación, (E)vento, (O)tro');
            $table->text('subject')->nullable();
            $table->text('html_template');
            $table->text('text_template')->nullable();
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
        Schema::dropIfExists('email_templates');
    }
}
