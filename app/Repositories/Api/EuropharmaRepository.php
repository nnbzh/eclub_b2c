<?php

namespace App\Repositories\Api;

class EuropharmaRepository extends ApiRepository
{
    protected string $key = 'europharma';

    public function calculateDeliveryCost($lat, $lng, $positions, $cityId, $ownerId = null)
    {
        return $this->client->post('app/delivery-amount', [
            'lat'       => $lat,
            'lng'       => $lng,
            'positions' => $positions,
            'city_id'   => $cityId,
            'owner_id'  => $ownerId
        ])->json();
    }


}
