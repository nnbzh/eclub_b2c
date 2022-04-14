<?php

namespace App\Services\Payment\Providers\OneDivision;

use App\Models\City;
use App\Models\Interfaces\IBillable;
use App\Services\Payment\Contracts\PaymentProviderContract;

class OneDivisionService implements PaymentProviderContract
{

    public function pay($amount, IBillable $transactionable, array $params, City $city = null)
    {
        // TODO: Implement pay() method.
    }

    public function revoke()
    {
        // TODO: Implement revoke() method.
    }
}
