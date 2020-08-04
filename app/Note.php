<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['description', 'user_id', 'noteable_type', 'noteable_id'];

    protected $with = ['user'];

    /**
     * Note morphs to models in noteable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function noteable()
    {
        // morphTo($name = noteable, $type = noteable_type, $id = noteable_id)
        // requires noteable_type and noteable_id fields on $this->table
        return $this->morphTo();
    }

    /**
     * Note belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
