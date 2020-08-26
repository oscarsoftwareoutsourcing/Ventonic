<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTemplatesTable extends Migration
{
    public function up()
    {
        /**
         * Descomentar si se va a usar esta tabla que es la que viene por defecto con el paquete
         * laravel-database-mail-templates
         */
        /*Schema::create('mail_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mailable');
            $table->text('subject')->nullable();
            $table->text('html_template');
            $table->text('text_template')->nullable();
            $table->timestamps();
        });*/
    }
}
