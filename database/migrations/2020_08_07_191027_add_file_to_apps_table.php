<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileToAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->longText('iframe')->nullable()->comment('Iframe para video de explicacion');
            $table->longText('info')->nullable()->comment('Informacion general de la app');
            $table->string('code',20)->nullable()->comment('Codigo de la app');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->dropColumn('iframe');
            $table->dropColumn('info');
            $table->dropColumn('code');
        });
    }
}
