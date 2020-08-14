<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldContactTypeIdToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->unsignedBigInteger('contact_type_id')->nullable();
            $table->foreign('contact_type_id')->references('id')->on('contact_types')->onDelete('cascade');
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
            $table->string('type', 255)->nullable();
            $table->dropForeign(['contact_type_id']);
            $table->dropColumn('contact_type_id');
        });
    }
}
