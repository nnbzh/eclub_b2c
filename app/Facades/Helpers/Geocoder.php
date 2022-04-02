<?php

namespace App\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class Geocoder extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'geocoder';
    }
}
