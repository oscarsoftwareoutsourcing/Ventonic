<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'last_name','image','email','web', 'phone',
                           'company', 'address', 'city', 'province',
                           'postal_code', 'sector', 'notes', 'share',
                           'type', 'country_id','user_id', 'favorite',
                            'cargo', 'address_latitude', 'address_longitude',
                            'private','type_contact'];


    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Country', 'country_id');
    }

    public function contactGroupUser(){
        return $this->belongsTo('App\ContactGroupUser', 'contact_id');
    }

    /**
     * Contact has many CallEvents.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function callEvents()
    {
        return $this->hasMany(CallEvent::class);
    }

    /**
     * Contact has many Tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public static function checkedFavorite($contact){
        $checked='';
        if(isset($contact) && $contact!="empresa" && $contact!="persona"){
            $contact_favorite=$contact['favorite'];
            if($contact_favorite==1){
                $checked='checked';
            }
        }

        return $checked;
    }

    public static function getIcon($contact_type){
        $icon='fa fa-male';
        if( $contact_type == 'empresa' ){
            $icon='fa fa-building-o';
        }

        return $icon;
    }

    public static function getUserId($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('user_id');
        return $contact;
    }

    public static function getUserName($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('name');
        return $contact;
    }

    public static function getUserLastName($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('last_name');
        return $contact;
    }

    public static function getUserEmail($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('email');
        return $contact;
    }

    public static function getUserCompany($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('company');
        return $contact;
    }

    public static function getUserPrivate($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('private');
        return $contact;
    }

    public static function getUserType($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('type');
        return $contact;
    }

    public static function getUserTypeContact($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('type_contact');
        return $contact;
    }

    public static function getUserPhone($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('phone');
        return $contact;
    }

    public static function getUserFavorite($contact_id){

        $contact=Contact::where('id', (int)$contact_id)->value('favorite');
        return $contact;
    }

    public function negotiation(){
        return $this->belongsToMany(Negotiation::class);
    }
}
