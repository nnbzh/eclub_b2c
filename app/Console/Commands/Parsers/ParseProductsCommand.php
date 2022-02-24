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
        try {
            DB::connection('shop')
                ->table('product')
                ->select(
                    'id as source_id',
                    'sub_limit',
                    'name',
                    'category_id',
                    'status',
                    'model as barcode',
                    'upc as sku',
                    'supplier',
                    'recipe as by_recipe',
                    'special as is_special',
                    'country',
                )
                ->orderBy('id')
                ->chunk(500, function ($products) {
                    $helperProduct  = new Product();
                    $newProducts    = [];

                    foreach ($products as $product) {
                        $helperProduct->setTranslation('name', 'ru', $product->name);
                        $newProducts[] = [
                            'source_id' => $product->source_id,
                            'sub_limit' => $product->sub_limit,
                            'name' => json_encode($helperProduct->getTranslations('name'), JSON_UNESCAPED_UNICODE),
                            'category_id' => $product->category_id,
                            'is_active' => $product->status === 1,
                            'barcode' => $product->barcode,
                            'sku' => $product->sku,
                            'supplier' => $product->supplier,
                            'by_recipe' => $product->by_recipe ?? false,
                            'is_special' => $product->is_special ?? false,
                            'country' => $product->country,
                            'updated_at' => Carbon::now(),
                            'created_at' => Carbon::now()
                        ];
                    }

                    if (! empty($newProducts)) {
                        Product::query()->whereIn('source_id', $products->pluck('source_id'))->delete();
                        Product::query()->insert($newProducts);
                    }
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
