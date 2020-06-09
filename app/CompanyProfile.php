<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Cache;

class CompanyProfile extends Model
{
    protected $fillable = ['country', 'dni_rif', 'status', 'user_id', 'answered', 'photo'];
    protected $append = ['country_flag'];

    /**
     * CompanyProfile belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function oportunity()
    {
        return $this->hasMany('App\Oportunity', 'company_id');
    }

    public function getCountryFlagAttribute()
    {
        return $this->setCountryFlag($this->phone_mobil_country);
    }

    public function setCountryFlag($callingCode)
    {
        $countries = Cache::rememberForever('countries', function () {
            return Countries::all();
        });
        $flag = false;
        $callingCode = str_replace("+", "", $callingCode);

        foreach ($countries as $country) {
            if (isset($country['dialling']['calling_code']) && $country['dialling']['calling_code'] && in_array($callingCode, $country['dialling']['calling_code'])) {
                $flag = $country->flag->flag_icon;
                break;
            }
        }

        return $flag;
    }
}
