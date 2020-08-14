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
    protected $fillable = ['name', 'app_id', 'user_id', 'url','token', 'parameteres', 'status', 'user_id_referred'];
    // protected $fillable = ['name', 'app_id', 'user_id', 'url','token', 'parameteres', 'status'];
    protected $guarded = ['id'];
    protected $with = ['user', 'userReferred'];

    /**
     * Widget belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Widget belongs to UserReferred.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userReferred()
    {
        return $this->belongsTo(User::class, 'user_id_referred');
    }
}
