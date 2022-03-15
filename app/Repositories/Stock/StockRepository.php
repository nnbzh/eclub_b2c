<?php

namespace App\Repositories\Stock;

use App\Models\PharmacyStock;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockRepository implements StockRepositoryInterface
{
    public function updateStocksByCityId($cityId)
    {
        $query = DB::connection('stock')
            ->table('pharmacy')
            ->select(
                DB::raw('CAST(SUM(FLOOR(ow_stock.quantity)) as SIGNED) as quantity'),
                'stock.sku as sku',
                'pharmacy.city_id_site as city_id',
                'stock.changed_at as changed_at'
            )
            ->leftJoin('stock', 'stock.number', '=', 'pharmacy.number')
            ->where('pharmacy.city_id_site', $cityId)
            ->where('pharmacy.site_status', '=', 1)
            ->where('stock.sku', '<>', null)
            ->groupBy('stock.sku')
            ->orderBy('stock.sku');
        $query->chunk(2000, function ($stocks) use ($cityId) {
            Stock::query()->where('city_id', $cityId)->whereIn('sku', $stocks->pluck('sku'))->delete();
            Stock::query()->insert(json_decode(json_encode($stocks), true));
            Log::info("Successfully updated city stocks for city with ID=$cityId");
        });
    }

    public function updateStocksByPharmacyNumber($pharmacyNumber)
    {
        DB::connection('stock')
            ->table('stock')
            ->select(
                DB::raw('CAST(SUM(FLOOR(ow_stock.quantity)) as SIGNED) as quantity'),
                'stock.sku as sku',
                'stock.number as pharmacy_id',
                'stock.changed_at as changed_at'
            )
            ->where('stock.number', $pharmacyNumber)
            ->groupBy('stock.sku')
            ->orderBy('stock.sku')
            ->chunk(2000, function ($stocks) use ($pharmacyNumber) {
                PharmacyStock::query()
                    ->where('pharmacy_id', $pharmacyNumber)
                    ->whereIn('sku', $stocks->pluck('sku'))
                    ->delete();
                PharmacyStock::query()->insert(json_decode(json_encode($stocks), true));
                Log::info("Successfully updated pharmacy stocks for pharmacy with number=$pharmacyNumber");
            });
    }

    public function getExistingProductsInCity($products, $cityId)
    {
        return Stock::query()
            ->select('sku', 'quantity')
            ->whereIn('sku', $products->pluck('sku'))
            ->where('city_id', $cityId)
            ->where('quantity', '>', 0)
            ->get();
    }

    public function getExistingProductsInPharmacy($products, $pharmacyNumber)
    {
        // TODO: Implement getExistingProductsInPharmacy() method.
    }
}
