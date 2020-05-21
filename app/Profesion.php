<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    protected $table = 'profesions';
    protected $fillable = ['description'];
    
    public function skill()
    {
        return $this->hasMany('App\Skill', 'profesion_id');
    }

    public static function getProfesion($id){
        $profesion=Profesion::where('id', (int)$id)->value('description');
        return $profesion;
    }

}
