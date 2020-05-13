<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['option_type', 'selection_type', 'priority', 'name', 'options', 'status'];

    protected $casts = [
        'options' => 'object',
    ];
}
