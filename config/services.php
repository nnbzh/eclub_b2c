<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'sms' => [
        'connection'    => env('SMS_CONNECTION', 'sync'),
        'sender'        => env('SMS_SENDER_NAME', 'Eclub'),
        'mobizon'       => [
            'key'           => env('MOBIZON_API_KEY')
        ],
    ],
    'tarantool' => [
        'enabled' => env('TARANTOOL_ENABLED', true)
    ],
    'api'       => [
        'europharma' => [
            'host'   => 'https://api.europharma.kz',
            'apiKey' => env('EUROPHARMA_API_KEY')
        ],
        'slot' => [
            'host'   => 'https://slot.europharma.kz/v1',
            'apiKey' => env('SLOT_API_KEY')
        ],
        'elogist' => [
            'host'   => 'https://api.elogist.kz/v1',
            'apiKey' => env('ELOGIST_API_KEY')
        ]
    ]
];
