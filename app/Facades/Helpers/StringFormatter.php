<?php

namespace App\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class StringFormatter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'string_formatter';
    }
}
