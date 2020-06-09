<?php

use PragmaRX\Countries\Package\Countries;

if (! function_exists('get_country_flag')) {
    function get_country_flag($callingCode)
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
