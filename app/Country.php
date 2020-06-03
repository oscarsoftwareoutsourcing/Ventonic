<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['name', 'iso_code_cca2', 'iso_code_cc3'];

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Country has many Players.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function players()
    {
        return $this->hasMany(Player::class);
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public static function getCountry($id){
        $country=Country::where('id',(int)$id)->value('name');
        return $country;
    }
}
