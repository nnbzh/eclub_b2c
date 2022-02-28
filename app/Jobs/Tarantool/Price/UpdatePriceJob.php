<?php

namespace App\Jobs\Tarantool\Price;

use App\Models\City;
use App\Services\Price\PriceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle() {
        $cities = City::query()->select('id')->where('is_active', true)->get();

        foreach ($cities as $city) {
            dispatch(new UpdatePriceByCityIdJob($city->id))->onConnection('redis');
        }
    }
}
