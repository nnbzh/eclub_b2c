<?php

namespace App\Console\Commands\Parsers;

use App\Models\City;
use App\Models\DeliveryZone;
use App\Repositories\Api\EclubRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ParseDeliveryZones extends Command
{
    protected $signature = 'parse:delivery-zones';

    public function __construct(private EclubRepository $eclubRepository)
    {
        parent::__construct();
    }

    public function handle() {
        try {
            $zones  = collect($this->eclubRepository->getDeliveryZones()['data']);
            $ids    = $zones->pluck('city.id')->unique()->toArray();
            $cities = City::query()
                ->with('deliveryZones')
                ->whereIn('id', $ids)
                ->get()
                ->keyBy('id');
            foreach ($zones as $zone) {
                if (! $cities->has($zone['city_id'])) {
                    continue;
                }
                $city           = $cities[$zone['city_id']];
                $coordinates    = json_decode($zone['coordinates']);
                if (! $city->deliveryZones->where('coordinates', $coordinates)->isNotEmpty()) {
                    $city->deliveryZones()->create(['coordinates' => $coordinates]);
                }
            }

            $this->info("Successfully parsed delivery zones");
            Log::info("Successfully parsed delivery zones");
        } catch (\Exception $e) {
            $this->error('Failed while parsing delivery zones');
            $this->error($e->getMessage());
            Log::error('Failed while parsing delivery zones', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }
    }
}
