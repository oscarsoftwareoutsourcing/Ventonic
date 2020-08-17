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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Contact
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    // Type
    public function type()
    {
        return $this->belongsTo(NegotiationType::class, 'neg_type_id');
    }

    // Status
    public function status()
    {
        return $this->belongsTo(NegotiationStatus::class, 'neg_status_id');
    }

    /**
     * Negotiation belongs to NegotiationProcess.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function negotiationProcess()
    {
        return $this->belongsTo(NegotiationProcess::class, 'neg_process_id');
    }

    // Related users
    public function related_users()
    {
        return $this->belongsToMany(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function negotiationProcessHistories()
    {
        return $this->belongsToMany(NegotiationProcess::class, 'negotiation_process_history')->withTimestamps();
    }

    public function negotiationStatusHistories()
    {
        return $this->belongsToMany(NegotiationStatus::class, 'negotiation_statuses_history')->withTimestamps();
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function events()
    {
        return $this->morphMany(Event::class, 'eventable');
    }

    public function emails()
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function callEvents()
    {
        return $this->morphMany(CallEvent::class, 'calleventable');
    }

    public function tasks()
    {
        return $this->morphMany(Task::class, 'taskable');
    }
}
