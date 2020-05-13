<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\CompanyProfile;
use App\CompanyAnsweredSurvey;

class CreateCompanyAnsweredSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_answered_surveys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('option_index');
            $table->bigInteger('question_id')->unsigned();
            $table->foreign('question_id')
                  ->references('id')->on('questions')->onDelete('restrict')->onUpdate('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::transaction(function () {
            $companyProfiles = CompanyProfile::whereNotNull('answered')->get();
            if (!$companyProfiles->isEmpty()) {
                foreach ($companyProfiles as $profile) {
                    $companyAnswered = $profile->user->companyAnsweredSurveys();
                    if ($companyAnswered) {
                        $companyAnswered->delete();
                    }
                    if ($profile->answered !== null) {
                        foreach (json_decode($profile->answered) as $answered) {
                            CompanyAnsweredSurvey::create(
                                [
                                    'option_index' => (int)$answered->option_index,
                                    'question_id' => (int)$answered->question_id,
                                    'user_id' => (int)$profile->user->id,
                                ]
                            );
                        }
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_answered_surveys');
    }
}
