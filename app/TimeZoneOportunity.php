<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeZoneOportunity extends Model
{
    protected $table = 'time_zone_oportunities';
    protected $fillable = ['description', 'details'];
}
