<?php

namespace App\Services\Sms\Contracts;

use App\Services\Sms\Sms;

interface SmsDriverInterface
{
    public function send(Sms $sms);
}
