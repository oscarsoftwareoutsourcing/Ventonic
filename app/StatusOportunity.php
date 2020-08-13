<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusOportunity extends Model
{
    protected $table = 'status_oportunitys';

    /**
     * StatusOportunity has many Oportunities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oportunities()
    {
        return $this->hasMany(Oportunity::class, 'status_id');
    }

    public static function getStatus($id){
        $status=StatusOportunity::where('id',(int)$id)->value('id');
        $nameStatus='';
        if($status==1){
            $nameStatus='Borrador';
        }elseif($status==2){
            $nameStatus='Publicada';
        }elseif($status==3){
            $nameStatus='Cancelada';
        }elseif($status==4){
            $nameStatus='Cerrada';
        }

        return $nameStatus;
    }
}
