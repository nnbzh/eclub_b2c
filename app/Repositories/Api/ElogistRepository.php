<?php

namespace App\Repositories\Api;

class ElogistRepository extends ApiRepository
{
    protected string $key = 'elogist';

    public function getDelayedSlotsByCityId($cityId, $date)
    {
        return $this->client->get("orders/load", [
                'city_id'   => $cityId,
                'slot_date' => $date
            ])->json();
    }
}
