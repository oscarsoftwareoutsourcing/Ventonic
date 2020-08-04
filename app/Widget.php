<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'widget';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
<<<<<<< HEAD
    protected $fillable = ['name', 'app_id', 'user_id', 'url','token', 'parameteres', 'status'];
=======
    // protected $fillable = ['name', 'app_id', 'user_id', 'url','token', 'parameteres', 'status'];
    protected $guarded = ['id'];
>>>>>>> components
}
