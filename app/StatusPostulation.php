<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPostulation extends Model
{
    protected $table = 'status_postulations';
    protected $fillable = ['description'];
}
