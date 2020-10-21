<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aplicant extends Model
{
    protected $table = 'aplicants';
    protected $fillable = [
        'user_id','oportunity_id','type-message','status_postulations_id', 'message','favorite', 'video'
    ];

    public function oportunity()
    {
        return $this->belongsTo('App\Oportunity', 'oportunity_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    // Functions
    public function statusPostulation()
    {
        return $this->belongsTo('App\StatusPostulation', 'estatus_postulations_id');
    }

    public static function verifyPostulation($id_seller, $oportunity_id)
    {
        $result=null;
        $verify = Aplicant::where('user_id', $id_seller)->where('oportunity_id', $oportunity_id)->value('id');
        if ($verify!=null) {
            $result=$verify;
        }
        return $result;
    }

    public static function postulationsTrue($user_id)
    {
        $result=false;
        $verify=Aplicant::where('user_id', (int)$user_id)->value('id');

        if ($verify>0) {
            $result=true;
        }
        return $result;
    }

    public static function postulationTrue($user_id, $oportunity_id)
    {
        $result=false;
        $verify=Aplicant::where('user_id', (int)$user_id)->where('oportunity_id', (int)$oportunity_id)->value('id');

        if ($verify>0) {
            $result=true;
        }
        return $result;
    }

    public static function datePostulation($id, $oportunity_id)
    {
        $postulation=Aplicant::where('user_id', (int)$id)->where('oportunity_id', (int)$oportunity_id)->value('created_at');
        $date=date('d-m-Y', strtotime($postulation));

        return $date;
    }

    public static function countAplicant($oportunity_id)
    {
        $number=Aplicant::where('oportunity_id', (int)$oportunity_id)->count();

        return $number;
    }

    public static function getDate($id)
    {
        $valor=User::where('id', $id)->value('created_at');
        $result=date('d-m-Y', strtotime($valor));
        return $result;
    }

    public static function getStatus($id)
    {
        $valor=User::where('id', $id)->value('status');
        return $valor;
    }

    // Scopes
    public function scopeMovil($query, $movil)
    {
        if ($movil) {
            return $query->whereNotNull('phone_mobil');
        }
    }

    public function scopeFoto($query, $foto)
    {
        if ($foto) {
            return $query->whereNotNull('photo');
        }
    }

    public function scopeVideo($query, $video)
    {
        if ($video) {
            return $query->whereNotNull('video');
        }
    }

    public function scopeLikeind($query, $likeind)
    {
        if ($likeind) {
            return $query->whereNotNull('likeind');
        }
    }
}
