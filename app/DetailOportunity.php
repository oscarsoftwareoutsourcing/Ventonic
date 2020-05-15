<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOportunity extends Model
{
    //
    protected $table = 'details_oportunities';
    protected $fillable = ['title', 'experience', 'image'];

    public function ubicationOportunity()
    {
        return $this->hasOne('App\UbicationOportunity');
    }

    public function jobType()
    {
        return $this->hasOne('App\JobType');
    }

    public function timeZoneOportunity()
    {
        return $this->hasOne('App\TimeZoneOportunity');
    }

    public function oportunity()
    {
        return $this->hasOne('App\Oportunity');
    }

}
