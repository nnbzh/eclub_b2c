<?php

namespace App\Console\Commands\Parsers;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParseProductsCommand extends Command
{
    protected $signature = 'parse:products';
    protected $description = 'Parses products from shop';

    public function handle()
    {
        $iteration = 0;
        try {
            DB::connection('shop')
                ->table('product')
                ->select(
                    'id',
                    'sub_limit',
                    'name',
                    'category_id',
                    'status',
                    'model as barcode',
                    'upc as sku',
                    'manufacturer_id',
                    'recipe as by_recipe',
                    'special as is_special',
                    'country',
                )
                ->orderBy('id')
                ->chunk(500, function ($products) use (&$iteration) {
                    $helperProduct      = new Product();
                    $shopProducts       = [];

                    foreach ($products as $product) {
                        $helperProduct->setTranslation('name', 'ru', $product->name);
                        $shopProducts[] = [
                            'id' => $product->id,
                            'sub_limit' => $product->sub_limit,
                            'name' => json_encode($helperProduct->getTranslations('name'), JSON_UNESCAPED_UNICODE),
                            'category_id' => $product->category_id,
                            'is_active' => $product->status === 1,
                            'barcode' => $product->barcode,
                            'sku' => $product->sku,
                            'brand_id' => $product->manufacturer_id ?? null,
                            'by_recipe' => $product->by_recipe === 1,
                            'is_special' => $product->is_special  === 1,
                            'country' => $product->country,
                        ];
                    }

                    $nonExistingProducts = collect($shopProducts)->whereNotIn(
                        'sku',
                        Product::query()
                            ->select('sku')
                            ->orderBy('id')
                            ->limit(500)
                            ->offset(500 * $iteration)
                            ->get()
                            ->pluck('sku')
                    );

                    if ($nonExistingProducts->isNotEmpty()) {
                        $nonExistingProducts->transform(function ($product) {
                            $product['created_at'] = Carbon::now()->toDateTimeString();
                            $product['updated_at'] = Carbon::now()->toDateTimeString();

                            return $product;
                        });

                        Product::query()->insert($nonExistingProducts->toArray());
                    }

                    \Batch::update($helperProduct, $shopProducts, 'sku');
                    $iteration++;
                });
            $this->info("Successfully parsed products");
            Log::info("Successfully parsed products");
        } catch (\Exception $e) {
            $this->error('Failed while parsing products');
            Log::error('Failed while parsing products', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }
    }
}
