<?php

namespace App\Services\Push;

use App\Services\Push\Contracts\PushDriverInterface;
use App\Services\Push\Drivers\ExpoPushDriver;
use Illuminate\Support\ServiceProvider;

class PushServiceProvider extends ServiceProvider
{
    public $bindings = [
        PushDriverInterface::class => ExpoPushDriver::class
    ];

    public function register()
    {
        $this->app->bind('pushService', PushService::class);
    }
}
