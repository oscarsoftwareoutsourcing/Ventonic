<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WidgetData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'widget_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['widget_id', 'origin', 'info_data'];

    protected $with = ['widget'];

    /**
     * WidgetData belongs to Widget.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function widget()
    {
        return $this->belongsTo(Widget::class);
    }
}
