<?php

namespace App\Helpers;

class GeocoderHelper
{
    const EARTH_RADIUS = 6371.009;

    public function distanceBetween($baseLat, $baseLng, $lat, $lng) {
        $lat1 = deg2rad($lat);
        $lon1 = deg2rad($lng);
        $lat2 = deg2rad($baseLat);
        $lon2 = deg2rad($baseLng);

        $delta_lat = $lat2 - $lat1;
        $delta_lng = $lon2 - $lon1;

        $hav_lat = (sin($delta_lat / 2))**2;
        $hav_lng = (sin($delta_lng / 2))**2;

        $distance = 2 * asin(sqrt($hav_lat + cos($lat1) * cos($lat2) * $hav_lng));

        return self::EARTH_RADIUS * $distance;
    }
}
