<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusOportunity extends Model
{
    protected $table = 'status_oportunitys';

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
