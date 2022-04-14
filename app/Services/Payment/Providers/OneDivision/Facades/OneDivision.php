<?php

namespace App\Services\Payment\Providers\OneDivision\Facades;

use Illuminate\Support\Facades\Facade;

class OneDivision extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'oneDivision';
    }
}
