<?php

namespace App\Services\DeliveryMethod;

use App\Repositories\Api\EuropharmaRepository;
use App\Repositories\CityRepository;
use App\Repositories\DeliveryMethodRepository;

class DeliveryMethodService
{
    public function __construct(
        private DeliveryMethodRepository $deliveryMethodRepository,
        private EuropharmaRepository $europharmaRepository,
        private CityRepository $cityRepository,
    )
    {
    }

    public function list($cityId = null, $user = null, $marketNumber = null) {
        return $this->deliveryMethodRepository->list($cityId, $user, $marketNumber);
    }

    public function available($data)
    {
        $city = $this->cityRepository->findById($data['city_id']);

        return $this->europharmaRepository->getAvailableDeliveryMethods(
            $city->id,
            $data['lat'],
            $data['lng'],
            $data['positions'],
        );
    }
}
