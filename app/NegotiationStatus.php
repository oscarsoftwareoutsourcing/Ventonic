<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NegotiationStatus extends Model
{
    public function negotiation(){
        return $this->belongsTo(Negotiation::class);
    }
}
