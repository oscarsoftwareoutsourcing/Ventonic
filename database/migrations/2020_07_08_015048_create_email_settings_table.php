<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('incoming_server_host');
            $table->integer('incoming_server_port');
            $table->string('outgoing_server_host');
            $table->integer('outgoing_server_port');
            $table->enum('protocol', ['imap', 'pop3'])->default('imap');
            $table->enum('encryption', ['false', 'ssl', 'tls', 'notls', 'starttls'])->default('ssl');
            $table->boolean('validate_cert')->default(true);
            $table->string('name');
            $table->string('email');
            $table->string('username');
            $table->text('password')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('email_settings');
    }
}
