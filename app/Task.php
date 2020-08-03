<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'tasked_at', 'tasked_time', 'remember_type', 'remember_at', 'remember_time',
        'contact_id', 'task_queue_id', 'task_priority_id', 'task_type_id', 'taskable_type', 'taskable_id'
    ];

    protected $with = ['contact'];

    /**
     * Task morphs to models in taskable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function taskable()
    {
        return $this->morphTo();
    }

    /**
     * Task belongs to TaskPriority.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taskPriority()
    {
        return $this->belongsTo(TaskPriority::class);
    }

    /**
     * Task belongs to TaskQueue.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taskQueue()
    {
        return $this->belongsTo(TaskQueue::class);
    }

    /**
     * Task belongs to TaskType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }

    /**
     * Task belongs to Contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
