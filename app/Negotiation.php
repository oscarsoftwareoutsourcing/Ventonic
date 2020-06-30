<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{

    // Relations
    // User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Contact
    public function contact() {
        return $this->belongsTo(Contact::class);
    }

    // Type
    public function type() {
        return $this->hasOne(NegotiationType::class);
    }

    // Status
    public function status() {
        return $this->hasOne(NegotiationStatus::class);
    }
}