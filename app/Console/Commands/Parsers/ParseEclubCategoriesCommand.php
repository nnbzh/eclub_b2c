<?php

namespace App\Console\Commands\Parsers;

use App\Models\Category;
use App\Models\City;
use App\Models\DeliveryZone;
use App\Repositories\Api\EclubRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ParseEclubCategoriesCommand extends Command
{
    protected $signature = 'parse:eclub-categories';

    public function __construct(private EclubRepository $eclubRepository)
    {
        parent::__construct();
    }

    public function handle() {
        try {
            $compselections = collect($this->eclubRepository->compselections()['data']);
            foreach ($compselections as $compselection) {
                $parent = Category::query()->updateOrCreate(
                    ['id' => $compselection['id'] + 10000],
                    [
                        'is_active' => $compselection['status'] == 1,
                        'name' => json_decode($compselection['old_name'], true)
                    ]);
                foreach ($compselection['compilations'] as $compilation) {
                    $new = Category::query()->updateOrCreate(
                        ['id'   => $compilation['id'] + 20000],
                        [
                            'name'      => $compilation['custom_name'],
                            'is_active' => $compilation['status'] == 'enabled',
                            'parent_id' => $parent->id
                        ]
                    );
                    if (! $new->image()->exists()) {
                        $new->image()->create([
                            'src' => 'img_v2'
                        ]);
                    }
                    $remoteCats = $this->eclubRepository->categories($compilation['id'])['data'] ?? [];
                    $localCats = Category::query()->whereIn('id', array_column($remoteCats, 'id'))->get();
                    foreach ($localCats as $localCat) {
                        $localCat->parent_id = $new->id;
                        $localCat->save();
                    }
                }
            }

            $this->info("Successfully parsed eclub categories");
            Log::info("Successfully parsed eclub categories");
        } catch (\Exception $e) {
            $this->error('Failed while parsing eclub categories');
            $this->error($e->getMessage());
            Log::error('Failed while parsing eclub categories', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }
    }
}
