<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Oportunity extends Model
{
    protected $table = 'oportunitys';
    protected $fillable = [
        'user_id', 'job_type_id', 'ubication_oportunity_id',
        'status_id', 'description', 'cargo','sectors',
        'skills', 'functions', 'antiguedad', 'ubication',
        'image', 'email_contact', 'web', 'title', 'expire_at','amount','leads','is_funnel'
    ];
    protected $dates = ['expire_at'];

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

    public function aplicant()
    {
        return $this->hasOne('App\Aplicant');
    }

    /**
     * Oportunity belongs to StatusOportunity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function statusOportunity()
    {
        // belongsTo(RelatedModel, foreignKey = statusOportunity_id, keyOnRelatedModel = id)
        return $this->belongsTo(StatusOportunity::class, 'status_id');
    }

    //functions estatics

    public static function getstatus($id)
    {
        $status=Oportunity::where('id', (int)$id)->value('status_id');
        $class='';

        if ($status == 2) {
            $class='publicada alert alert-success mt-3';
        } elseif ($status == 3) {
            $class='cancelada text-danger alert alert-danger mt-3';
        } elseif ($status == 4) {
            $class='cerrada text-secondary alert alert-secondary mt-3';
        } elseif ($status == 1) {
            $class='cerrada text-secondary borrador mt-3';
        }
        return $class;
    }

    public static function getStyle($id)
    {
        $status=Oportunity::where('id', (int)$id)->value('status_id');
        $style='';

        if ($status == 2) {
            $style='color:#24A866!important;';
        } elseif ($status == 3) {
            $style='color:#D6434A!important;';
        } elseif ($status == 4) {
            $style='color:grey!important;';
        } elseif ($status == 1) {
            $style='color:#fff!important;background:2A304A!important';
        }
        return $style;
    }

    public static function getSector($sector, $id)
    {
        $sectorArray=explode(",", $sector);
        $selected='';

        foreach ($sectorArray as $i) {
            $arrayid = SectorOportunity::where('id', $i)->value('id');
            if ($arrayid == $id) {
                $selected='selected';
            }
        }
        return $selected;
    }

    public static function getFunction($function, $id)
    {
        $functionArray=explode(",", $function);
        $selected='';

        foreach ($functionArray as $i) {
            $arrayid = JobFunction::where('id', $i)->value('id');
            if ($arrayid == $id) {
                $selected='selected';
            }
        }
        return $selected;
    }


    public static function getAptitudes($aptitudes, $id)
    {
        $AptidudesArray=explode(",", $aptitudes);
        $selected='';

        foreach ($AptidudesArray as $i) {
            $arrayid = Aptitud::where('id', $i)->value('id');

            if ($arrayid == $id) {
                $selected = 'selected';
            }
        }
        return $selected;
    }

    public static function listSectors($sector)
    {
        $sectorsArray=explode(",", $sector);
        $sectors='';

        foreach ($sectorsArray as $i) {
            $description=SectorOportunity::where('id', $i)->value('description');
            $sectors.=" $description ".'/';
        }
        $nameSectores = rtrim($sectors, '/');
        return $nameSectores;
    }

    public static function strTags($description)
    {
        $result=strip_tags($description);
        return $result;
    }

    // Scopes
    public function scopeCargos($query, $cargo)
    {
        if ($cargo) {
            return $query->where("cargo", "LIKE", "%$cargo%");
        }

        return $query;
    }

    public function scopeUbication($query, $ubication)
    {
        if ($ubication) {
            return $query->where("ubication", "LIKE", "%$ubication%");
        }

        return $query;
    }
}
