<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallEvent extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'called_at', 'called_time', 'description', 'follow_task', 'contact_id', 'call_result_id', 'user_id',
        'calleventable_type', 'calleventable_id'
    ];

    protected $with = ['contact'];

    /**
     * CallEvent belongs to CallResult.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function callResult()
    {
        return $this->belongsTo(CallResult::class);
    }

    /**
     * CallEvent belongs to Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    /**
     * CallEvent belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * CallEvent has many Negotiations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function negotiations()
    {
        return $this->hasMany(Negotiation::class);
    }

    /**
     * CallEvent morphs to models in calleventable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function calleventable()
    {
        return $this->morphTo();
    }
}
