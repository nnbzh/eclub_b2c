<?php

namespace App\Services\Payment\Providers\Paybox;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PayboxRepository
{
    private $client;
    private $key;
    private $merchantId;
    private $baseUrl = 'https://api.paybox.money';

    public function __construct()
    {
        $this->merchantId   = config('payment.paybox.merchantId');
        $this->key          = config('payment.paybox.secretKey');
        $this->client       = Http::baseUrl($this->baseUrl);
    }

    public function getUrlForCardAddition(int $userId) {
        $params = [
            'pg_user_id'    => "1234",
            'pg_post_link'  => route('bankcard.paybox.store.callback'),
            'pg_back_link'  => 'http://site.kz/back',
        ];
        $response = $this->sendRequest("v1/merchant/$this->merchantId/cardstorage/add", $params);

        return $response['body']->pg_redirect_url;
    }

    private function sendRequest($url, $params) {
        $params['pg_merchant_id']   = $this->merchantId;
        $params['pg_salt']          = "sAWumVI6p37o2TLS";
        $params['pg_testing_mode']  = 1;
        $operation                  = explode('/', $url);
        $operation                  = end($operation);

        ksort($params);
        array_unshift($params, $operation);
        $params[]           = $this->key;
        $params['pg_sig']   = md5(implode(';', $params));

        unset($params[0], $params[1]);

        $response = $this->client->post($url, $params);;
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
}
