<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusNegociation extends Model
{
    public function negociationSeller(){
        return $this->hasMany('App\NegociationSeller');
    }

    public function negociationCompany(){
        return $this->hasMany('App\NegociationCompany');
    }

}
