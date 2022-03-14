<?php

namespace App\Console\Commands\Parsers;

use App\Models\Product;
use App\Models\ProductDescription;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParseProductDescriptionsCommand extends Command
{
    protected $signature = 'parse:descriptions';

    public function handle()
    {
        $iteration = 0;
        try {
            DB::connection('shop')
                ->table('product_description')
                ->whereNotNull('description')
                ->where('description', '<>', '')
                ->orderBy('product_id')
                ->chunk(100, function ($descriptions) {
                    $descriptions = $descriptions->groupBy('product_id');
                    $productDescriptions = ProductDescription::query()
                        ->whereIn('product_id', $descriptions->keys())
                        ->orderBy('product_id')
                        ->get()
                        ->keyBy('product_id');
                    $helperDescr = new ProductDescription();
                    $newDescriptions = [];

                    foreach ($descriptions as $productId => $description) {
                        foreach ($description as $item) {
                            if (! empty($productDescriptions[$productId])) {
                                $helperDescr = $productDescriptions[$productId]->setTranslation('description', $item->language, $item->description);
                            } else {
                                $helperDescr = $helperDescr->setTranslation('description', $item->language, $item->description);
                            }
                        }

                        $newDescriptions[$productId] = [
                            'product_id'    => $productId,
                            'description'   => json_encode($helperDescr->getTranslations('description'), JSON_UNESCAPED_UNICODE),
                            'created_at'    => empty($productDescriptions[$productId]) ? Carbon::now() : null,
                        ];
                        array_filter($newDescriptions[$productId]);
                    }

                    $descrsToCreate = collect($newDescriptions)->whereNotNull('created_at');
                    $descrsToUpdate = collect($newDescriptions)->whereNotIn('product_id', $descrsToCreate->pluck('product_id'));

                    if ($descrsToCreate->isNotEmpty()) {
                        ProductDescription::query()->insert($descrsToCreate->toArray());
                    }

                    if ($descrsToUpdate->isNotEmpty()) {
                        \Batch::update($helperDescr, $descrsToUpdate->toArray(), 'product_id');
                    }

                })
            ;
            $this->info("Successfully parsed descriptions");
            Log::info("Successfully parsed descriptions");
        } catch (\Exception $e) {
            $this->error('Failed while parsing descriptions');
            Log::error('Failed while parsing descriptions', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }
    }
}
