<?php

namespace App\Helpers;

class OrderChannel
{
    const IOS = 'ios';
    const ANDROID = 'android';

    const CHANNELS = [
        self::IOS       => 7,
        self::ANDROID   => 8
    ];
}
