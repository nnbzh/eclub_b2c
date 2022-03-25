<?php

namespace App\Helpers;

class OrderStatus
{
    const NEW                   = 'new';
    const PROCESSING            = 'processing';
    const COURIER_TAKE          = 'courier_take';
    const COURIER_QUEUE         = 'courier_queue';
    const COURIER_DELIVERED     = 'delivered';
    const PICKUP                = 'pickup';
    const PICKUP_ISSUED         = 'pickup_issued';
    const CANCELED              = 'canceled';

    public static function getRuValue($value) {
        return trans("order_statuses.$value");
    }
}
