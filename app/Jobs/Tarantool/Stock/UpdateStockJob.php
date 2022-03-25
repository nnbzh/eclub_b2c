<?php

namespace App\Jobs\Tarantool\Stock;

use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStockJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle() {
        $cities = City::query()->select('id')->where('is_active', true)->get();

        foreach ($cities as $city) {
            dispatch(new UpdateStockByCityIdJob($city->id))->onConnection('redis');
        }
    }
}
