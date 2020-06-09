<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Support\Facades\Cache;

class SellerProfile extends Model
{
    protected $table = 'seller_profiles';

    protected $fillable = [
        'phone_mobil_country', 'phone_mobil', 'phone_home_country', 'phone_home',
        'photo', 'video', 'linkedin', 'status', 'user_id', 'answered'
    ];

    protected $casts = [
        'answered' => 'object',
    ];

    protected $append = ['mobil_country_flag', 'home_country_flag'];

    /**
     * SellerProfile belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMobilCountryFlagAttribute()
    {
        return $this->setCountryFlag($this->phone_mobil_country);
    }

    public function getHomeCountryFlagAttribute()
    {
        return ($this->phone_home_country) ? $this->setCountryFlag($this->phone_home_country) : '';
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
