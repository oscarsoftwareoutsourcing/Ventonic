<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallResult extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * CallResult has many CallEvents.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function callEvents()
    {
        return $this->hasMany(CallEvent::class);
    }
}
