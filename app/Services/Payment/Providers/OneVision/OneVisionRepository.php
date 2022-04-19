<?php

namespace App\Services\Payment\Providers\OneVision;

use Illuminate\Support\Facades\Http;

class OneVisionRepository
{
    private $client;
    private $apiKey;
    private $secret;
    private $baseUrl = 'https://1vision.app';

    public function __construct()
    {
        $this->apiKey   = config('payment.one_vision.apiKey', 'c84f1ac0-e4f0-0131-5298-70921c57c2a2');
        $this->secret   = config('payment.one_vision.secret', '13148649399496d8');
        $this->client   = Http::baseUrl($this->baseUrl);
    }

    public function getUrlForCardAddition(int $userId) {
        $params = [
            'reference'     => "$userId",
            'amount'        => 1000,
            'currency'      => 'KZT',
            'description'   => 'Add card for user'
        ];
        $response = $this->sendRequest("pay/recurrent", $params);

        return $response['body']->pg_redirect_url;
    }

    private function sendRequest($url, $params) {
        $params['api_key']      = $this->apiKey;
        $params['expiration']   = now()->addHour()->toDateTimeString();
        $params['ip']           = request()->ip();
        [$data, $sign]          = $this->createSignature($params);
        $response = $this->client->post($url, [
            'data' => $data,
            'sign' => $sign
        ]);
        $response = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
        $response = json_decode(json_encode($response));

        return [
            'status'    => $this->isSuccessful($response),
            'body'      => $response
        ];
    }

    private function isSuccessful($response): bool
    {
        return $response->pg_status === 'ok';
    }

    private function createSignature($params = []) {
        $data = base64_encode(json_encode($params));
        $sign = hash_hmac('md5', $data, $this->secret);

        return [$data, $sign];
    }
}
