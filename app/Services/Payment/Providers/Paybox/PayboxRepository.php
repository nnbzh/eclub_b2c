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
        $this->client       = Http::baseUrl($this->baseUrl)->withHeaders(['Content-Type' => 'application/x-www-form-urlencoded']);
    }

    public function getUrlForCardAddition(int $userId) {
        $params = [
            'pg_user_id'    => $userId,
            'pg_post_link'  => route('bankcard.paybox.store.callback'),
            'pg_back_link'  => route('bankcard.paybox.store.callback'),
        ];
        $this->sendRequest("v1/merchant/$this->merchantId/cardstorage/add", $params);
    }

    private function sendRequest($url, $params, $returnBody = true) {
        $params['pg_merchant_id']   = $this->merchantId;
        $params['pg_salt']          = Str::random();
        $operation                  = explode('/', $url);
        $operation                  = end($operation);

        ksort($params);
        array_unshift($params, $operation);
        $params[]           = $this->key;
        $params['pg_sig']   = md5(implode(';', $params));
        unset($params[0], $params[1]);

        $response = $this->client->post($url, $params);
        $response = simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
        $response = json_decode(json_encode($response));

        return $returnBody ? $response : $response->pg_status === 'ok';
    }

    function makeFlatParamsArray($arrParams, $parent_name = '')
    {
        $arrFlatParams = [];
        $i = 0;
        foreach ($arrParams as $key => $val) {
            $i++;
            /**
             * Имя делаем вида tag001subtag001
             * Чтобы можно было потом нормально отсортировать и вложенные узлы не запутались при сортировке
             */
            $name = $parent_name . $key . sprintf('%03d', $i);
            if (is_array($val)) {
                $arrFlatParams = array_merge($arrFlatParams, makeFlatParamsArray($val, $name));
                continue;
            }
            $arrFlatParams += array($name => (string)$val);
        }

        return $arrFlatParams;
    }
}
