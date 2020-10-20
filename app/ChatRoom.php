<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['type'];

    /**
     * ChatRoom morphs to models in origenable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function origenable()
    {
        return $this->morphTo();
    }

    /**
     * ChatRoom has many ChatRoomUsers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chatRoomUsers()
    {
        return $this->hasMany(ChatRoomUser::class);
    }

    /**
     * ChatRoom has many Messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
