<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'last_name', 'email','web', 'phone', 
                           'company', 'address', 'city', 'province', 
                           'postal_code', 'sector', 'notes', 'share', 
                           'type', 'country_id','user_id', 'favorite', 
                            'cargo', 'address_latitude', 'address_longitude'];


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
}
