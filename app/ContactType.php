<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactType extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * ContactType has many Contacts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
