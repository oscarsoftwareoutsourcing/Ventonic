<?php

namespace App;
use App\GroupUser;

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

    public static function getUserByGroup($group_id){
        $users_txt='';
        $users=GroupUser::where('group_id', $group_id)->get();
        foreach($users as $usuario){
            $users_txt.=$usuario->user->name.", ";
        }
        $usuarios=rtrim($users_txt, ', ');
        return $usuarios;
    }

}
