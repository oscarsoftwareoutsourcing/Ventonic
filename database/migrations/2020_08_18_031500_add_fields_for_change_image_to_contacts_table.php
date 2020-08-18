<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsForChangeImageToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->boolean('allow_change_image')->default(true)
                  ->comment('Indica si se permite la modificación de la imagen');
            $table->dateTime('image_updated_at')->nullable()
                  ->comment('Fecha de la última modificación de la imagen');
            $table->unsignedBigInteger('change_image_user_id')->nullable()
                  ->comment('Identificador del último usuario que modificó la imagen');
            $table->foreign('change_image_user_id')->references('id')->on('users')->onDelete('restrict');
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
            $table->dropForeign(['change_image_user_id']);
            $table->dropColumn('change_image_user_id');
            $table->dropColumn('image_updated_at');
            $table->dropColumn('allow_change_image');
        });
    }
}
