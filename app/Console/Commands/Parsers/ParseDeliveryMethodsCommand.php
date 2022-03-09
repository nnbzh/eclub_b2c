<?php

namespace App\Console\Commands\Parsers;

use App\Models\DeliveryMethod;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ParseDeliveryMethodsCommand extends Command
{
    protected $signature = 'parse:delivery-methods';
    protected $description = 'Parse delivery-methods from Europharma API';

    public function handle()
    {
        try {
            DB::table('delivery_method_city')->truncate();
            $deliveryMethods = Http::baseUrl(config('services.api.europharma.host'))
                    ->withHeaders(['Authorization' => 'Bearer '. config('services.api.europharma.apiKey')])
                    ->get('app/delivery-methods')
                    ->json()['items'] ?? [];
            $methods    = [];
            $cities     = [];
            $helperMethod = new DeliveryMethod();

            foreach ($deliveryMethods as $method) {
                $helperMethod->setTranslation('name', 'ru', $method['name']);
                $methods[] = [
                    'id'        => $method['id'],
                    'name'      => json_encode($helperMethod->getTranslations('name'), JSON_UNESCAPED_UNICODE),
                    'is_active' => $method['enabled'] == 1
                ];

                $cities[$method['id']] = $method['cities'];
            }

            $nonExistingMethods = collect($methods)->whereNotIn('id', DeliveryMethod::query()->get()->pluck('id'));

            if ($nonExistingMethods->isNotEmpty()) {
                $nonExistingMethods->transform(function ($method) {
                    $method['created_at'] = Carbon::now()->toDateTimeString();
                    $method['updated_at'] = Carbon::now()->toDateTimeString();

                    return $method;
                });
                DeliveryMethod::query()->insert($nonExistingMethods->toArray());
            }

            \Batch::update($helperMethod, $methods, 'id');

            $newCities = [];

            foreach ($cities as $method_id => $city) {
                foreach ($city as $cityObject) {
                    $newCities[] = [
                        'delivery_method_id'    => $method_id,
                        'city_id'               => $cityObject['city_id'],
                        'min_price'             => $cityObject['min_price'],
                        'max_price'             => $cityObject['max_price'],
                        'cost'                  => $cityObject['cost'],
                        'is_active'             => $cityObject['enabled'] == 1,
                    ];
                }
            }

            DB::table('delivery_method_city')->insert($newCities);
            $this->info("Successfully parsed delivery methods");
            Log::info("Successfully parsed delivery methods");
        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->error('Failed while parsing delivery methods');
            Log::error('Failed while parsing delivery methods', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }

    }
}
