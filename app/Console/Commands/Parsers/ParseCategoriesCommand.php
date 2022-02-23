<?php

namespace App\Console\Commands\Parsers;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParseCategoriesCommand extends Command
{
    protected $signature = 'parse:categories';
    protected $description = 'Parses categories from shop';

    public function handle()
    {
        try {
            $localCategories    = Category::query()->get();
            $newCategories      = DB::connection('shop')
                ->table('category')
                ->whereIntegerNotInRaw('category.id', $localCategories->pluck('id'))
                ->orderBy('category.id')
                ->get();
            $helperCategory = new Category();
            $categories     = [];

            foreach ($newCategories as $category) {
                $helperCategory->setTranslation('name', 'ru', $category->name);
                $categories[] = [
                    'id'            => $category->id,
                    'name'          => json_encode($helperCategory->getTranslations('name'), JSON_UNESCAPED_UNICODE),
                    'is_active'     => $category->status ?? false,
                    'parent_id'     => $category->parent_id ?? null,
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }

            if (! empty($categories)) {
                Category::query()->insert($categories);
            }

            $this->info("Successfully parsed ".count($categories)." categories");
            Log::info("Successfully parsed ".count($categories)." categories");
        } catch (\Exception $e) {
            $this->error('Failed while parsing categories');
            Log::error('Failed while parsing categories', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }
    }
}
