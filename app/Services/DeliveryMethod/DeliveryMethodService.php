<?php

namespace App\Services\DeliveryMethod;

use App\Repositories\DeliveryMethodRepository;

class DeliveryMethodService
{
    public function __construct(private DeliveryMethodRepository $deliveryMethodRepository)
    {
    }

    public function list($cityId = null, $user = null, $marketNumber = null) {
        return $this->deliveryMethodRepository->list($cityId, $user, $marketNumber);
    }
}
