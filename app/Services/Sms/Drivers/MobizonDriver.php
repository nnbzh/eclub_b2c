<?php

namespace App\Services\Sms\Drivers;

use App\Services\Sms\Contracts\SmsDriverInterface;
use App\Services\Sms\Sms;
use Illuminate\Support\Facades\Http;

class MobizonDriver implements SmsDriverInterface
{
    const BASE_URL = 'https://api.mobizon.kz';

    protected $apiKey;
    protected $senderName;

    public function __construct()
    {
        $this->apiKey       = config('services.sms.mobizon.key');
        $this->senderName   = config('services.sms.sender');
    }

    public function send(Sms $sms)
    {
        $body = [
            'recipient' => $sms->receiver,
            'text'      => $sms->text,
            'from'      => $this->senderName
        ];
        $url = self::BASE_URL."/service/message/sendSmsMessage?output=json&api=v1&apiKey={$this->apiKey}";

        return Http::withHeaders(["content-type" => "application/x-www-form-urlencoded"])
            ->post($url, $body)
            ->json();
    }
}
