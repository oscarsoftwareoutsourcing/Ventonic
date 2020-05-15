<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model
{
    protected $table = 'oportunities';

    public function detailOportunity()
    {
        return $this->hasOne('App\DetailOportunity');
    }
    
    public function aplicant()
    {
        return $this->hasMany('App\Aplicant');
    }
}
