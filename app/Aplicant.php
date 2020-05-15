<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplicant extends Model
{
    protected $table = 'aplicants';
    protected $fillable = ['name'];

    public function oportunity()
    {
        return $this->hasMany('App\Oportunity');
    }

    public function profesion()
    {
        return $this->hasOne('App\Profesion');
    }

}
