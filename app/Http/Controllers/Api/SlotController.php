<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ApiServices\SlotService;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function __construct(private SlotService $slotService) {}

    public function today(Request $request) {
        $this->validate($request, [
            'city_id' => 'required|int|exists:cities,id'
        ]);

        return response()->json(['data' => $this->slotService->getSlotsForToday($request->city_id)]);
    }

    public function tomorrow(Request $request) {
        $this->validate($request, [
            'city_id' => 'required|int|exists:cities,id'
        ]);

        return response()->json(['data' => $this->slotService->getSlotsForTomorrow($request->city_id)]);
    }
}
