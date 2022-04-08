<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Cache;

class LoginService
{
    public function requestOtp($phone) {
        $phone  = \StringFormatter::onlyDigits($phone);
        $code   = rand(1000, 9999);

        if (app()->environment() != 'production') {
            $code = $phone % 10000;
        } else {
            \SMS::to($phone)->text("Код для входа в приложение Eclub: $code")->send();
        }

        Cache::put("$phone/code", $code, 120);
    }
}
