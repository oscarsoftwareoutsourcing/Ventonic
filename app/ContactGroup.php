<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    protected $table = 'contact_group';
    protected $fillable = ['contact_id', 'group_id'];
    
    public function contact()
    {
        return $this->hasMany('App\Contact');
    }

    public static function getContactGroup($contact_id, $group_id){
        $true=false;
        $group=ContactGroup::where('contact_id', $contact_id)->where('group_id', $group_id)->value('id');
        if($group>0){
            $true=true;
        }
// var_dump($true); die();
        return $true;
    }
}
