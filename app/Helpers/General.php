<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class General
{
    public static function setActiveMenu($compareUrls, $hasSub = false)
    {
        $class = ($hasSub) ? 'open' : 'active';
        $currentUrl = Route::current()->getName();

        if (is_array($compareUrls)) {
            $active = '';
            foreach ($compareUrls as $url) {
                if ($currentUrl == $url) {
                    return $class;
                }
            }
            return $active;
        }

        return ($currentUrl == $compareUrls) ? $class : '';
    }
}
