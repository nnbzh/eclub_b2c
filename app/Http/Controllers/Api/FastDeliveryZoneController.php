<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PharmacyResource;
use App\Services\DeliveryZone\FastDeliveryZoneService;
use Illuminate\Http\Request;

class FastDeliveryZoneController extends Controller
{
    public function __construct(private FastDeliveryZoneService $fastDeliveryZoneService)
    {
    }

    public function isInside(Request $request) {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required'
        ]);
        $intersection = $this->fastDeliveryZoneService->isInside($request->lat, $request->lng);
        if (! $intersection['inside']) {
            return response()->json(['data' => [
                'success'       => $intersection['inside'],
                'pharmacy'      => null,
                'coordinates'   => [],
            ]]);
        }

        return response()->json(['data' => [
            'success'       => $intersection['inside'],
            'pharmacy'      => new PharmacyResource($intersection['pharmacy']),
            'coordinates'   => $intersection['coordinates']
        ]]);
    }
}
