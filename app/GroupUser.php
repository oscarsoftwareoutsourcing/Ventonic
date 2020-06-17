<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'group_user';
    protected $fillable = ['group_id','user_id'];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }
}
