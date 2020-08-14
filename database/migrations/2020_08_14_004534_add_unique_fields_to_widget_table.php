<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Widget;

class AddUniqueFieldsToWidgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $widgets = Widget::orderBy('user_id')->orderBy('user_id_referred')->orderBy('url')->get();
        $existsUserId = null;
        $existsUserIdReferred = null;
        $existsUrl = null;
        foreach ($widgets as $widget) {
            if (Widget::find($widget->id)) {
                Widget::where([
                    'user_id' => $widget->user_id, 'user_id_referred' => $widget->user_id_referred,
                    'url' => $widget->url
                ])->where('id', '!=', $widget->id)->delete();
            }
        }
        Schema::table('widget', function (Blueprint $table) {
            $table->unique(['user_id', 'user_id_referred', 'url']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('widget', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'user_id_referred', 'url']);
        });
    }
}
