<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
    protected $fillable = [
        'phone_mobil_country', 'phone_mobil', 'phone_home_country', 'phone_home',
        'photo', 'video', 'linkedin', 'status', 'user_id', 'answered'
    ];

    protected $casts = [
        'answered' => 'object',
    ];

    /**
     * SellerProfile belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Scopes
    

}
