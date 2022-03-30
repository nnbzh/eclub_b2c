<?php

namespace App\Services\Payment\Contracts;

use App\Models\City;
use App\Models\Interfaces\IBillable;

interface PaymentProviderContract
{
    public function pay($amount, IBillable $transactionable, array $params, City $city = null);
    public function revoke();
}
