<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NegotiationStatus extends Model
{
    public function negotiation(){
        return $this->belongsTo(Negotiation::class);
    }

    public function negotiationHistories()
    {
        return $this->belongsToMany(Negotiation::class, 'negotiation_statuses_history')->withTimestamps();
    }
}
