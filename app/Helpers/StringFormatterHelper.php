<?php

namespace App\Helpers;

class StringFormatterHelper
{
    public function onlyDigits($str) {
        return preg_replace('/[^0-9]/', '', $str);
    }
}
