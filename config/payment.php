<?php

return [
    'paybox' => [
        'merchantId'    => env('PAYBOX_MERCHANT_ID'),
        'secretKey'     => env('PAYBOX_SECRET_KEY'),
    ],
    'cloudpayments' => [
        'almaty' => [
            'public'    => 'pk_833eeeb811a850b4d9f8f1ce20cb9',
            'private'   => 'd8d1173df0c9819acefd01927f2a882a',
        ]
    ],
    'one_vision'    => [
        'secret' => '',
        'apiKey' => ''
    ]
];
