<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{

    protected $casts = [
        'active' => 'boolean',
    ];


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
        return $this->belongsTo(NegotiationType::class, 'neg_type_id');
    }

    // Status
    public function status() {
        return $this->belongsTo(NegotiationStatus::class, 'neg_status_id');
    }

    // Related users
    public function related_users() {
        return $this->belongsToMany(User::class);
    }
}