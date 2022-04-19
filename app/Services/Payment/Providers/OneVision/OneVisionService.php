<?php

namespace App\Services\Payment\Providers\OneVision;

use App\Models\City;
use App\Models\Interfaces\IBillable;
use App\Models\User;
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

    public function getUrlForCardAddition(User $user) {
        return $this->oneVisionRepository->getUrlForCardAddition($user->id);
    }
}
