<?php

namespace App\Services\Payment\Providers\Paybox;

use App\Models\City;
use App\Models\Interfaces\IBillable;
use App\Services\Payment\Contracts\PaymentProviderContract;

class PayboxService implements PaymentProviderContract
{
    public function pay($amount, IBillable $transactionable, array $params, City $city = null)
    {
        $responses = collect([
            [null],
            ['transaction_id' => rand(100000000, 9999999999)]
        ]);

        return $responses->random();
    }

    public function revoke()
    {
        // TODO: Implement revoke() method.
    }
}
