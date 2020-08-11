<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name', 'last_name','image','email','web', 'phone', 'company', 'address', 'city', 'province',
        'postal_code', 'sector', 'notes', 'share', 'type', 'country_id','user_id', 'favorite',
        'cargo', 'address_latitude', 'address_longitude', 'private','type_contact'
    ];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /*public function contactGroupUser()
    {
        return $this->belongsTo('App\ContactGroupUser', 'contact_id');
    }*/

    public function negotiation()
    {
        return $this->belongsToMany(Negotiation::class);
    }

    /**
     * Contact belongs to Groups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function groups()
    {
        return $this->belongsToMany(Groups::class);
    }

    /**
     * Contact has many ContactGroups.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contactGroups()
    {
        // hasMany(RelatedModel, foreignKeyOnRelatedModel = contact_id, localKey = id)
        return $this->hasMany(ContactGroup::class);
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

    public static function checkedFavorite($contact)
    {
        $checked='';

        if (isset($contact) && $contact!="empresa" && $contact!="persona") {
            $contact_favorite=$contact['favorite'];
            if ($contact_favorite==1) {
                $checked='checked';
            }
        }

        return $checked;
    }

    public static function getIcon($contact_type)
    {
        $icon='fa fa-male';

        if ($contact_type == 'empresa') {
            $icon='fa fa-building-o';
        }

        return $icon;
    }

    public static function getUserId($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('user_id');
        return $contact;
    }

    public static function getUserName($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('name');
        return $contact;
    }

    public static function getUserLastName($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('last_name');
        return $contact;
    }

    public static function getUserEmail($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('email');
        return $contact;
    }

    public static function getUserCompany($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('company');
        return $contact;
    }

    public static function getUserPrivate($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('private');
        return $contact;
    }

    public static function getUserType($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('type');
        return $contact;
    }

    public static function getUserTypeContact($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('type_contact');
        return $contact;
    }

    public static function getUserPhone($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('phone');
        return $contact;
    }

    public static function getUserFavorite($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('favorite');
        return $contact;
    }

    public static function getImage($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->value('image');
        return $contact;
    }

    public static function getIniNames($contact_id)
    {
        $contact=Contact::where('id', (int)$contact_id)->get();
        return strtoupper(substr($contact->name, 0, 1).substr($contact->last_name, 0, 1));
    }

    public function getIntialsNameAttribute()
    {
        return strtoupper(substr($this->name, 0, 1) . substr($this->last_name, 0, 1));
    }

    public function getFullNameAttribute()
    {
        return $this->name.' '. $this->last_name;
    }
}
