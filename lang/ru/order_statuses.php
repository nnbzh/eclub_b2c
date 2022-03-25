<?php

return [
    \App\Helpers\OrderStatus::NEW                => 'Новый заказ',
    \App\Helpers\OrderStatus::PROCESSING         => 'В процессе обработки',
    \App\Helpers\OrderStatus::CANCELED           => 'Отменен',
    \App\Helpers\OrderStatus::PICKUP_ISSUED      => 'Самовывоз сделан',
    \App\Helpers\OrderStatus::PICKUP             => 'Ожидает самовывоза',
    \App\Helpers\OrderStatus::COURIER_DELIVERED  => 'Доставлен',
    \App\Helpers\OrderStatus::COURIER_TAKE       => 'На доставке',
    \App\Helpers\OrderStatus::COURIER_QUEUE      => 'В ожидании курьера',
];
