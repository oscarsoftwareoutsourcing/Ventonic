<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoomUser extends Model
{
    protected $table = "chat_room_user";
    protected $with = ["user"];
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['chat_room_id', 'user_id'];

    /**
     * ChatRoomUser belongs to ChatRoom.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    /**
     * ChatRoomUser belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
