<?php

namespace App\Jobs\Tarantool\Stock;

use App\Models\Pharmacy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePharmacyStockJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle() {
        $pharmacies = Pharmacy::query()->select('number')->where('is_active', true)->get();

        foreach ($pharmacies as $pharmacy) {
            dispatch(new UpdatePharmacyStockByPharmacyNumberJob($pharmacy->number))->onConnection('redis');
        }
    }
}
