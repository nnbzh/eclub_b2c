<?php

namespace App\Services\Payment\Providers\OneVision;

use App\Models\City;
use App\Models\Interfaces\IBillable;
use App\Services\Payment\Contracts\PaymentProviderContract;

class OneVisionService implements PaymentProviderContract
{
    public function __construct(private OneVisionRepository $oneVisionRepository)
    {
    }

    public function pay($amount, IBillable $transactionable, array $params, City $city = null)
    {
        // TODO: Implement pay() method.
    }

    public function revoke()
    {
        // TODO: Implement revoke() method.
    }

    public function getUrlForCardAddition() {
        return $this->oneVisionRepository->getUrlForCardAddition(1);
    }
}
