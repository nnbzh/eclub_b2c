<?php

namespace App\Console\Commands\Parsers;

use App\Models\PaymentMethod;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ParsePaymentMethodsCommand extends Command
{
    protected $signature = 'parse:payment-methods';
    protected $description = 'Parse payment-methods from Europharma API';

    public function handle()
    {
        try {
            DB::table('payment_method_city')->truncate();
            $paymentMethods = Http::baseUrl(config('services.api.europharma.host'))
                    ->withHeaders(['Authorization' => 'Bearer '. config('services.api.europharma.apiKey')])
                    ->get('app/payment-methods')
                    ->json()['items'] ?? [];
            $methods    = [];
            $cities     = [];
            $helperMethod = new PaymentMethod();

            foreach ($paymentMethods as $method) {
                $helperMethod->setTranslation('name', 'ru', $method['name']);
                $methods[] = [
                    'id'        => $method['id'],
                    'name'      => json_encode($helperMethod->getTranslations('name'), JSON_UNESCAPED_UNICODE),
                    'is_active' => $method['enabled'] == 1
                ];

                $cities[$method['id']] = $method['cities'];
            }

            $nonExistingMethods = collect($methods)->whereNotIn('id', PaymentMethod::query()->get()->pluck('id'));

            if ($nonExistingMethods->isNotEmpty()) {
                $nonExistingMethods->transform(function ($method) {
                    $method['created_at'] = Carbon::now()->toDateTimeString();
                    $method['updated_at'] = Carbon::now()->toDateTimeString();

                    return $method;
                });
                PaymentMethod::query()->insert($nonExistingMethods->toArray());
            }

            \Batch::update($helperMethod, $methods, 'id');

            $newCities = [];

            foreach ($cities as $method_id => $city) {
                foreach ($city as $cityObject) {
                    $newCities[] = [
                        'payment_method_id' => $method_id,
                        'city_id'           => $cityObject['city_id'],
                    ];
                }
            }

            DB::table('payment_method_city')->insert($newCities);
            $this->info("Successfully parsed payment methods");
            Log::info("Successfully parsed payment methods");
        } catch (\Exception $e) {
            $this->error('Failed while parsing payment methods');
            Log::error('Failed while parsing payment methods', [
                'Message'   => $e->getMessage(),
                'File'      => $e->getFile(),
                'Line'      => $e->getLine(),
            ]);
        }

    }
}
