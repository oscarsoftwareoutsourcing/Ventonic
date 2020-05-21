<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function profesion()
    {
        return $this->belongsTo('App\Profesion');
    }

    public function oportunity()
    {
        return $this->belongsToMany('App\Oportunity');
    }
}
