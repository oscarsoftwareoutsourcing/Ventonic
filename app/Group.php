<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['name', 'user_id'];

    public function groupUser()
    {
        return $this->hasMany('App\GroupUser');
    }

    public function inivitation()
    {
        return $this->hasMany('App\Invitation');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }


}
