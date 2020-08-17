<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NegotiationProcess extends Model
{
    protected $table = 'negotiation_process';

    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name', 'conversion'];

    /**
     * NegotiationProcess has many Negotiations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function negotiations()
    {
        return $this->hasMany(Negotiation::class, 'neg_process_id');
    }

    public function negotiationHistories()
    {
        return $this->belongsToMany(Negotiation::class, 'negotiation_process_history')->withTimestamps();
    }
}
