<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorOportunity extends Model
{
    protected $table = 'sector_oportunitys';
    protected $fillable = ['description'];

    public function profesion()
    {
        return $this->hasMany('App\Profesion');
    }

    public static function getSector($id){
        $sector=SectorOportunity::where('id', (int)$id)->value('description');
        return $sector;
    }
}
