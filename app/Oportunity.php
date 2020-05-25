<?php

namespace App;
use App\Skill;
use App\SectorOportunity;
use App\Profesion;

use Illuminate\Database\Eloquent\Model;


class Oportunity extends Model
{
    protected $table = 'oportunitys';
    protected $fillable = ['user_id', 'job_type_id', 'ubication_oportunity_id', 
                           'sector_id', 'status_id', 'description', 'cargo','sectors', 
                           'skills', 'functions', 'antiguedad', 'ubication',
                            'image', 'email_contact', 'web'];

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

    public function skill()
    {
        return $this->belongsToMany('App\Skill');
    }

    //functions estatics

    public static function verifySkill($skill_id){
        $skill_name=Skill::where('id',$skill_id)->value('description');
        return $skill_name;
    }


    public static function getstatus($id){
        $status=Oportunity::where('id', (int)$id)->value('status_id');
        $class='';

        if($status==2){
            $class='publicada alert alert-success mt-3';
        }else if($status==3){
            $class='cancelada alert alert-danger mt-3';
        }else if($status==4){
            $class='cerrada alert alert-secondary mt-3';
        }else if($status==1){
            $class='cerrada borrador mt-3';
        }
        return $class;
    }

    public static function getSector($sector, $id){
        $sectorArray=explode(",", $sector);
        $selected='';
        foreach($sectorArray as $i){
            $arrayid=SectorOportunity::where('id',$i)->value('id');
            if($arrayid == $id){
                $selected='selected';
            }
        }
        return $selected;
    }


    public static function getFunctions($function, $id){
        $functionArray=explode(",", $function);
        $selected='';
        foreach($functionArray as $i){
            $arrayid=Profesion::where('id',$i)->value('id');
            if($arrayid == $id){
                $selected='selected';
            }
        }
        return $selected;
    }


    // Scopes
    public function scopeCargos($query, $cargo){
        if($cargo)
            return $query->where("cargo", "LIKE", "%$cargo%");
    }

    public function scopeUbication($query, $ubication){
        if($ubication)
            return $query->where("ubication", "LIKE", "%$ubication%");
    }


}
