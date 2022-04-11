<?php

namespace App\Repositories\Api;

use Illuminate\Support\Facades\Http;

class SlotRepository extends ApiRepository
{
    protected $key = 'slot';

    public function getTodaySlotsByCityId($cityId)
    {
        return $this->client->get("today/$cityId")->json();
    }

    public function getTomorrowSlotsByCityId($cityId)
    {
        return $this->client->get("next-day/$cityId")->json();
    }
}
