<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NegotiationType extends Model
{
    public function negotiation() {
        return $this->belongsTo(Negotiation::class);
    }
}
