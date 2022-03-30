<?php

namespace App\Services\Payment\Providers\CloudPayments;

use App\Models\Interfaces\IBillable;
use App\Services\Payment\Contracts\PaymentProviderContract;

class CloudPaymentsService implements PaymentProviderContract
{
    public function __construct()
    {
    }

    public function pay($amount, IBillable $transactionable, $params, $cityId = null)
    {
        $responses = collect([
            [null],
            ['transaction_id' => rand(100000000, 9999999999)]
        ]);

        return $responses->random();
    }

    public function revoke()
    {
    }
}
