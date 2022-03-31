<?php

namespace App\Console\Commands\Parsers;

use App\Models\FastDeliveryZone;
use App\Models\Pharmacy;
use App\Repositories\Api\EclubRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ParseFastDeliveryZones extends Command
{
    protected $signature = 'parse:fast-delivery-zones';

    public function __construct(private EclubRepository $eclubRepository)
    {
        parent::__construct();
    }

    public function handle() {
        try {
            $zones  = collect($this->eclubRepository->getFastDeliveryZones()['data']);
            $numbers    = $zones->pluck('pharmacy.number')->unique()->toArray();
            $pharmacies = Pharmacy::query()
                ->with('fastDeliveryZones')
                ->whereIn('number', $numbers)
                ->get()
                ->keyBy('number');
            foreach ($zones as $zone) {
                if (! $pharmacies->has($zone['pharmacy']['number'])) {
                    continue;
                }
                $pharmacy   = $pharmacies[$zone['pharmacy']['number']];
                $coordinates = $zone['coordinates'];
                if (! $pharmacy->FastDeliveryZones->where('coordinates', $coordinates)->isNotEmpty()) {
                    $pharmacy->fastDeliveryZones()->create(['coordinates' => $coordinates]);
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
