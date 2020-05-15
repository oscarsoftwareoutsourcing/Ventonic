<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    protected $table = 'profesions';
    protected $fillable = ['description'];
    
    public function aplicant()
    {
        return $this->hasMany('App\Aplicant');
    }

    public function sectorOportunity()
    {
        return $this->hasOne('App\SectorOportunity');
    }
}
