<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsExternalKeyAndExternalContactToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('external_key')->nullable()->comment('identificador externo del contacto');
            $table->string('external_contact')->nullable()
                  ->comment('Determina la fuente externa desde donde se extraen los contactos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('external_key');
            $table->dropColumn('external_contact');
        });
    }
}
