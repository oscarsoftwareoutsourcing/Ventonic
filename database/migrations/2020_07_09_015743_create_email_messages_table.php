<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('message_id');
            $table->integer('message_nro');
            $table->string('subject')->nullable();
            $table->string('references')->nullable();
            $table->dateTime('message_at')->comment('fecha del mensaje');
            $table->longText('from')->comment('arreglo de objetos de quién(es) envía(n) el correo');
            $table->longText('to')->comment('arreglo de objetos de quién(es) recibe(n) el correo');
            $table->longText('cc')->nullable()->comment('arreglo de objetos de quién(es) recibe(n) una copia del correo');
            $table->longText('bcc')->nullable()->comment(
                'arreglo de objetos de quién(es) recibe(n) una copia oculta del correo'
            );
            $table->longText('reply_to')->comment('arreglo de objetos de direcciones de correo a los cuales responder');
            $table->longText('sender')->comment('Datos de la persona que envía el correo');
            $table->longText('attachments')->nullable()->comment('registra los archivos adjuntos al mensaje');
            $table->boolean('read')->default(false)->comment('condición para determinar si el mensaje fue leído');
            $table->enum('folder_type', [
                'inbox', 'trash', 'sent', 'junk', 'drafts', 'spam', 'archive', 'starred'
            ])->comment(
                'inbox = bandeja de entrada, trash = papelera, sent = enviado, junk = basura, drafts = borradores, ' .
                'spam = no deseado, archive = archivado, starred = correo marcado como favorito'
            );
            $table->string('labels')->nullable()->comment(
                'etiquetas de correo separadas por coma. Valores a permitir: personal, company, important, private'
            );
            $table->longText('body')->comment('cuerpo del mensaje del correo electrónico');
            $table->unsignedBigInteger('email_setting_id')->nullable();
            $table->foreign('email_setting_id')->references('id')->on('email_settings')
                  ->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('email_messages');
    }
}
