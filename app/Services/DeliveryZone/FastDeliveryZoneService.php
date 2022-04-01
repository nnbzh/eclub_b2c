<?php

namespace App\Services\DeliveryZone;

use App\Repositories\CityRepository;
use App\Repositories\FastDeliveryZoneRepository;

class FastDeliveryZoneService
{
    public function __construct(
        private FastDeliveryZoneRepository $fastDeliveryZoneRepository,
        private CityRepository $cityRepository
    )
    {
    }

    public function isInside($lat, $lng) {
        $fastDeliveryCities = $this->cityRepository->list(['has_fast_delivery' => 1]);
        $zones = $this->fastDeliveryZoneRepository->list([
            'city_id' => $fastDeliveryCities->pluck('id')->toArray()
        ]);
        $isInside   = false;
        $pharmacies = [];
        foreach ($zones as $zone) {
            $coordinates = $zone->coordinates;

            for ($i = 0, $j = sizeof($coordinates) - 1; $i < sizeof($coordinates); $j = $i++) {
                $xs = $coordinates[$i][0];
                $ys = $coordinates[$i][1];

                $xe = $coordinates[$j][0];
                $ye = $coordinates[$j][1];

                $intersect = $ys > $lat != $ye > $lat && $lng < (($xe - $xs) * ($lat - $ys)) / ($ye - $ys) + $xs;

                if ($intersect) {
                    $isInside = true;
                    $pharmacies[$zone->pharmacy->number] = $zone->pharmacy;
                }
            }
        }

        return [
            'inside'        => $isInside,
            'pharmacies'    => array_values($pharmacies),
        ];
    }
}
