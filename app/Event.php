<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'start_at', 'end_at', 'notes', 'category', 'private', 'place', 'user_id',
        'eventable_type', 'eventable_id'
    ];
    protected $with = ['user'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['category_color', 'category_name', 'category_color_class'];
    protected $dates = ['start_at', 'end_at'];

    /**
     * Event belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Event morphs to models in eventable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function eventable()
    {
        // morphTo($name = eventable, $type = eventable_type, $id = eventable_id)
        // requires eventable_type and eventable_id fields on $this->table
        return $this->morphTo();
    }

    public function getCategoryColorAttribute()
    {
        $color = '';
        switch ($this->category) {
            case 'B':
                $color = '#28C76F';
                break;
            case 'W':
                $color = '#FF9F43';
                break;
            case 'P':
                $color = '#EA5455';
                break;
            default:
                $color = '#7367F0';
                break;
        }

        return $color;
    }

    public function getCategoryNameAttribute()
    {
        $name = '';

        switch ($this->category) {
            case 'B':
                $name = 'Eventos';
                break;
            case 'W':
                $name = 'Recordatorios';
                break;
            case 'P':
                $name = 'Tareas';
                break;
            default:
                $name = 'Otros';
                break;
        }

        return $name;
    }

    public function getCategoryColorClassAttribute()
    {
        $class = '';
        switch ($this->category) {
            case 'B':
                $class = 'success';
                break;
            case 'W':
                $class = 'warning';
                break;
            case 'P':
                $class = 'danger';
                break;
            default:
                $class = 'primary';
                break;
        }

        return $class;
    }
}
