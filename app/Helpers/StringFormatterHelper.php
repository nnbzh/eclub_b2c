<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StringFormatterHelper
{
    public function onlyDigits($str) {
        return preg_replace('/[^0-9]/', '', $str);
    }

    public function maskPhone($phone) {
        $formatted[] = "+".substr($phone, 0, 1);
        $formatted[] = "(".substr($phone, 1, 3).")";
        $formatted[] = substr($phone, 4, 3);
        $formatted[] = "-".substr($phone, 7, 2);
        $formatted[] = "-".substr($phone, 9, 2);

        return implode('', $formatted);
    }
}
