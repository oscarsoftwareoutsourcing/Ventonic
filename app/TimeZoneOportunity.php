<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeZoneOportunity extends Model
{
    protected $table = 'time_zone_oportunitys';
    protected $fillable = ['description', 'details'];
}
