<?php

namespace App\Console\Commands\Parsers;

use App\Models\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParseCitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Parse cities from shop database";

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $cities     = City::query()->get();
            $newCities  = DB::connection('shop')
                ->table('city')
                ->whereNotIn('slug', $cities->pluck('slug'))
                ->get();
            $newCitiesArray = [];

            foreach ($newCities as $newCity) {
                $fields = json_decode($newCity->fields_json);
                $newCitiesArray[] = [
                    'id'    => $newCity->id,
                    'slug'  => $newCity->slug,
                    'name'  => $newCity->name,
                    'lat'   => $fields->lat,
                    'lng'   => $fields->lng,
                    'code'  => $fields->phone_code,
                    'number'    => $fields->phone,
                    'is_active' => $newCity->status,
                ];
            }
            City::query()->insert($newCitiesArray);
            $this->info('Successfully parsed cities');
            Log::info('Successfully parsed cities');
        } catch (\Exception $e) {
            $this->error('Failed while parsing cities');
            Log::error('Failed while parsing cities', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }
    }
}
