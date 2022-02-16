<?php

namespace App\Services\Sms;

use App\Services\Sms\Contracts\SmsDriverInterface;
use App\Services\Sms\Drivers\MobizonDriver;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public $bindings = [
        SmsDriverInterface::class => MobizonDriver::class
    ];

    public function register()
    {
        $this->app->bind('sms_service', SmsService::class);
    }
}
