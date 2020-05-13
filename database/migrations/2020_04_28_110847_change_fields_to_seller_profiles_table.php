<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsToSellerProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('seller_profiles', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('phone_code');
            $table->string('phone_mobil_country')->nullable();
            $table->string('phone_home_country')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('seller_profiles', function (Blueprint $table) {
            $table->string('country')->nullable();
            $table->string('phone_code')->nullable();
            $table->dropColumn('phone_mobil_country');
            $table->dropColumn('phone_home_country');
        });
    }
}
