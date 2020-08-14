<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['file', 'url', 'note', 'documentable_type', 'documentable_id', 'user_id'];

    /**
     * Document morphs to models in documentable_type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function documentable()
    {
        return $this->morphTo();
    }
}
