<?php

namespace App\Repositories\Price;

use App\Models\Price;
use Illuminate\Support\Facades\Log;

class PriceRepository implements PriceRepositoryInterface
{

    public function updatePricesByCityId($cityId)
    {
        \DB::connection('shop')
            ->table('price')
            ->select(
                \DB::raw('CAST(ow_price.sku as SIGNED) as sku'),
                'city_id as city_id',
                'price as price',
                'price_eclub as sub_price',
                'updated_at as changed_at'
            )
            ->where('city_id', $cityId)
            ->orderBy('sku')
            ->chunk(5000, function ($prices) use ($cityId) {
                Price::query()
                    ->where('city_id', $cityId)
                    ->whereIn('sku', $prices->pluck('sku'))
                    ->delete();
                Price::query()->insert(json_decode(json_encode($prices), true));
            });
        Log::info("Successfully updated prices for city with ID=$cityId");
    }

    public function updateStocksByCityId($cityId)
    {

    }

    public function updateStocksByPharmacyId($pharmacyId)
    {
        // TODO: Implement updateStocksByPharmacyId() method.
    }

    public function setPrices($products)
    {
        // TODO: Implement setPrices() method.
    }
}
