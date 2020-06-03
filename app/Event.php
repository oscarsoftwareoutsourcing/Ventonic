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
    protected $fillable = ['title', 'start_at', 'end_at', 'notes', 'tags', 'private', 'user_id'];
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Event belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
