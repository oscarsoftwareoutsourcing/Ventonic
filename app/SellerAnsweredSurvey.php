<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerAnsweredSurvey extends Model
{
    protected $fillable = ['option_index', 'question_id', 'user_id'];

    /**
     * SellerAnsweredSurvey belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
