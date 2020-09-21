<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarSetting extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['appType', 'credentials', 'api_key', 'secret_key', 'token', 'calendar_key', 'user_id'];

    /**
     * CalendarSetting belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
