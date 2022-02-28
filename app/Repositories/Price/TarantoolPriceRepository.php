<?php

namespace App\Repositories\Price;

use App\Models\Tarantool\Price;
use Illuminate\Support\Facades\Log;

class TarantoolPriceRepository implements PriceRepositoryInterface
{

    public function updatePricesByCityId($cityId)
    {
            \DB::connection('shop')
                ->table('price')
                ->select(
                    \DB::raw('CAST(ow_price.sku as SIGNED) as SKU'),
                    'city_id as CITY_ID',
                    'price as PRICE',
                    'price_eclub as SUB_PRICE',
                    'updated_at as CHANGED_AT'
                )
                ->where('city_id', $cityId)
                ->where('price', '!=', 0)
                ->orderBy('sku')
                ->chunk(5000, function ($prices) use ($cityId) {
                    Price::query()
                        ->where('city_id', $cityId)
                        ->whereIn('sku', $prices->pluck('SKU'))
                        ->delete();
                    Price::query()->insert(json_decode(json_encode($prices), true));
                });
            Log::info("Successfully updated prices for city with ID=$cityId");
    }

    public function updateStocksByPharmacyId($pharmacyId)
    {
    }
}
