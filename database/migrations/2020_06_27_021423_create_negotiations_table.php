<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegotiationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negotiations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->notNullable();
            $table->bigInteger('contact_id')->unsigned()->notNullable();
            $table->bigInteger('neg_type_id')->unsigned()->nullable();
            $table->bigInteger('neg_status_id')->unsigned()->nullable();
            $table->bigInteger('neg_process_id')->nullable();
            $table->string('title')->notNullable();
            $table->text('description');
            $table->double('amount', 8, 2);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('neg_type_id')->references('id')->on('negotiation_types')->onDelete('set Null');
            $table->foreign('neg_status_id')->references('id')->on('negotiation_statuses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('negotiations');
    }
}
