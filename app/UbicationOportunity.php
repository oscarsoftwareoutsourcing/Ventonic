<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UbicationOportunity extends Model
{
    protected $table = 'ubication_oportunitys';
    protected $fillable = ['description'];

    public static function getUbication($id){
        $ubication=UbicationOportunity::where('id', (int)$id)->value('description');
        return $ubication;
    }
}
