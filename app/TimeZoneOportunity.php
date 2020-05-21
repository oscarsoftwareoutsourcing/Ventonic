<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimeZoneOportunity extends Model
{
    protected $table = 'time_zone_oportunitys';
    protected $fillable = ['description', 'details'];

    public static function getTime($id){
        $time=TimeZoneOportunity::where('id', (int)$id)->value('description');
        return $time;
    }
}
