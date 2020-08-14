<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskPriority extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * TaskPriority has many Tasks.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
