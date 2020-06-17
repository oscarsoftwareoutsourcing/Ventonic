<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $table = 'invitations';
    protected $fillable = ['group_id','user_id', 'token', 'status'];

    public function group()
    {
        return $this->belongsTo('App\Group', 'group_id');
    }
}
