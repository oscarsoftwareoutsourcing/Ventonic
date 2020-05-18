<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model
{
    protected $table = 'oportunitys';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function jobType()
    {
        return $this->belongsTo('App\JobType', 'job_type_id');
    }

    public function typeOportunity()
    {
        return $this->belongsTo('App\TypeOportunity', 'type_oportunity_id');
    }

    public function ubicationOportunity()
    {
        return $this->belongsTo('App\UbicationOportunity', 'ubication_oportunity_id');
    }

    public function timeZoneOportunity()
    {
        return $this->belongsTo('App\TimeZoneOportunity', 'time_zone_id');
    }

    public function profesion()
    {
        return $this->belongsTo('App\Profesion', 'profesion_id');
    }
}
