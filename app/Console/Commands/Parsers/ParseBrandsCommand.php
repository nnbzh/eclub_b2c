<?php

namespace App\Console\Commands\Parsers;

use App\Models\Brand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParseBrandsCommand extends Command
{
    protected $signature = 'parse:brands';
    protected $description = 'Parses brands from shop';

    public function handle()
    {
        try {
            $localBrands    = Brand::query()->get();
            $newBrands      = DB::connection('shop')
                ->table('manufacturer')
                ->whereIntegerNotInRaw('manufacturer.id', $localBrands->pluck('id'))
                ->orderBy('manufacturer.id')
                ->get();
            $brands = [];

            foreach ($newBrands as $brand) {
                $brands[] = [
                    'id'    => $brand->id,
                    'name'  => $brand->name,
                    'slug'  => $brand->slug,
                ];
            }

            if (! empty($brands)) {
                Brand::query()->insert($brands);
            }

            $this->info("Successfully parsed ".count($brands)." brands");
            Log::info("Successfully parsed ".count($brands)." brands");
        } catch (\Exception $e) {
            $this->error('Failed while parsing brands');
            Log::error('Failed while parsing brands', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }
    }
}
