<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['subject', 'message', 'from_user_id', 'to_user_id', 'emailable_type', 'emailable_id'];
    protected $with = ['fromUser', 'toUser'];

    /**
     * Email belongs to FromUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Email belongs to ToUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    /**
     * Email morphs to models in emailable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function emailable()
    {
        return $this->morphTo();
    }
}
