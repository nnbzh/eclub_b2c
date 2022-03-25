<?php

namespace App\Facades\Helpers;

use Illuminate\Support\Facades\Facade;

class ProductPreprocessor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'productPreprocessor';
    }
}
