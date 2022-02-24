<?php

namespace App\Console\Commands\Parsers;

use App\Models\Market;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParseStoreCommand extends Command
{
    protected $signature = 'parse:store';

    protected $description = 'Parse stores from shop';

    public function handle()
    {
        try {
            DB::table('product_market')->truncate();
            DB::connection('shop')
                ->table('store')
                ->select('type', 'sku')
                ->orderBy('sku')
                ->chunk(1000, function ($stores) {
                    $newStores = [];
                    foreach ($stores as $store) {
                        $newStores[] = [
                            'sku' => $store->sku,
                            'market_number' => $store->type,
                        ];
                    }
                    $skus = $stores->pluck('sku')->unique();
                    $products = Product::query()
                        ->whereIn('sku', $skus)
                        ->get()
                        ->keyBy('sku');
                    $parsingProducts = DB::connection('shop')
                        ->table('product as pr')
                        ->whereIn('pr.upc', $skus)
                        ->get()
                        ->keyBy('upc');
                    $nonExistingProducts = array_diff_key($parsingProducts->toArray(), $products->toArray());
                    $newProducts = [];
                    $helperProduct  = new Product();

                    foreach ($nonExistingProducts as $nonExistingProduct) {
                        $newProducts[] = [
                            'source_id' => $nonExistingProduct->item_id,
                            'sub_limit' => $nonExistingProduct->sub_limit,
                            'name' => json_encode($helperProduct->getTranslations('name'), JSON_UNESCAPED_UNICODE),
                            'category_id' => $nonExistingProduct->category_id,
                            'is_active' => $nonExistingProduct->status === 1,
                            'barcode' => $nonExistingProduct->model,
                            'sku' => $nonExistingProduct->upc,
                            'brand_id' => $nonExistingProduct->manufacturer_id,
                            'by_recipe' => $nonExistingProduct->recipe ?? false,
                            'is_special' => $nonExistingProduct->special ?? false,
                            'country' => $nonExistingProduct->country,
                            'updated_at' => Carbon::now(),
                            'created_at' => Carbon::now()
                        ];
                    }

                    if (! empty($newProducts)) {
                        Product::query()->insert($newProducts);
                    }

                    if (! empty($newStores)) {
                        DB::table('product_market')->insert($newStores);
                    }
                });
            $this->info('Successfully parsed store');
            Log::info('Successfully parsed store');
        } catch (\Exception $e) {
            $this->error('Failed while parsing store');
            Log::error('Failed while parsing store', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }
    }
}
