<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model
{
    protected $table = 'oportunities';

    public function detailOportunity()
    {
        return $this->hasOne('App\DetailOportunity','oportunity_id');
    }
    
    // public function companyProfile()
    // {
    //     return $this->hasMany('App\CompanyProfile', 'oportunity_id');
    // }

    // public function aplicant()
    // {
    //     return $this->hasMany('App\Aplicant', 'oportunity_id');
    // }
}
