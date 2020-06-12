<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactGroupUser extends Model
{
    protected $table = '`contact_group_user';
    protected $fillable = ['contact_id', 'group_user_id'];
    
    public function contact()
    {
        return $this->hasMany('App\Contact');
    }
}
