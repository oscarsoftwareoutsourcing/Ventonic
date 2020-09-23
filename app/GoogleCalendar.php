<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoogleCalendar extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'color', 'google_id', 'user_id'];

    /**
     * GoogleCalendar belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
