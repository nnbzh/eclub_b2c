<?php

namespace App\Console\Commands\Parsers;

use App\Models\Image;
use App\Models\Product;
use App\Repositories\Api\EclubRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ParseProductImagesCommand extends Command
{
    protected $signature = 'parse:product-images';

    public function __construct(private EclubRepository $eclubRepository)
    {
        parent::__construct();
    }

    public function handle() {
        try {
            Product::query()
                ->orderBy('sku')
                ->chunk(1000,function ($products) {
                    $helperImage = new Image();
                    $products = $products->load('images')->keyBy('sku');
                    $images = $this->eclubRepository->getProductImages($products->pluck('sku')->toArray())['data'] ?? [];
                    $newImages = [];
                    foreach ($images as $sku => $arrImg) {
                        foreach ($arrImg as $img) {
                            $helperImage->setTranslation('src', 'ru', $img['src']);
                            $newImages[] = [
                                'imageable_type' => 'App\\Models\\Product',
                                'imageable_id'   => $products[$sku]->id,
                                'src'            => json_encode($helperImage->getTranslations('src'), JSON_UNESCAPED_UNICODE)
                            ];
                        }
                    }
                    Image::query()->insert($newImages);
                });
            $this->info("Successfully parsed product images");
            Log::info("Successfully parsed product images");
        } catch (\Exception $e) {
            $this->error('Failed while parsing product images');
            $this->error($e->getMessage());
            Log::error('Failed while parsing product images', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }
    }
}
