<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatedInNegotiations extends Model
{
    // Negotiation
    public function negotiations() {
        return $this->belongsTo(Negotiation::class);
    }

    // User
    public function users() {
        return $this->belongsTo(User::class);
    }
}
