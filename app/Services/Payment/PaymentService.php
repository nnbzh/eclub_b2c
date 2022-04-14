<?php

namespace App\Services\Payment;

use App\Models\City;
use App\Models\Interfaces\IBillable;
use App\Services\Payment\Providers\Paybox\Facades\Paybox;

class PaymentService
{
    public function pay($amount, IBillable $billable, $provider, array $params, City $city = null) {
        $paymentService = match ($provider) {
            'paybox' => Paybox::class,
            'one_division' => Paybox::class,
        };
        $response = $paymentService::pay($amount, $billable, $params, $city);
        if (isset($response['transaction_id'])) {
            $billable->transactions()->create([
                'transaction_id'    => $response['transaction_id'],
                'bankcard_id'       => $params['bankcard_id'],
                'fields_json'       => $params
            ]);
        }
    }
}
