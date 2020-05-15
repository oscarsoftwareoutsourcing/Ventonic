<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorOportunity extends Model
{
    protected $table = 'sectors_oportunities';
    protected $fillable = ['description'];

    public function profesion()
    {
        return $this->hasMany('App\Profesion');
    }
}
