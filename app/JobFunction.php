<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobFunction extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
