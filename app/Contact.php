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
}
