<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $table = 'job_types';
    protected $fillable = ['description'];

    public static function getType($id){
        $type=Jobtype::where('id', (int)$id)->value('description');
        return $type;
    }
}
