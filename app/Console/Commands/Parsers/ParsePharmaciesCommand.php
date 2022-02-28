<?php

namespace App\Console\Commands\Parsers;

use App\Models\Pharmacy;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ParsePharmaciesCommand extends Command
{
    protected $signature = 'parse:pharmacies';

    protected $description = 'Parse pharmacies from shop database';

    public function handle()
    {
        $pharmacies         = DB::connection('stock')->table('pharmacy')->get();

        foreach ($pharmacies as $pharmacy) {
            $chPhar = Pharmacy::query()
                ->where('number', $pharmacy->number)
                ->where('city_id', $pharmacy->city_id_site)
                ->first();

            if ($chPhar) {
                $chPhar->update([
                    'name'      => $pharmacy->name,
                    'address'   => $pharmacy->address,
                    'lat'       => $pharmacy->lat,
                    'lng'       => $pharmacy->lng,
                    'is_active' => $pharmacy->site_status ?? false,
                ]);
            } else {
                $chPhar = Pharmacy::create([
                    'city_id'   => $pharmacy->city_id_site,
                    'number'    => $pharmacy->number,
                    'name'      => $pharmacy->name,
                    'address'   => $pharmacy->address,
                    'lat'       => $pharmacy->lat,
                    'lng'       => $pharmacy->lng,
                    'is_active' => $pharmacy->site_status ?? false,
                ]);

                $chPhar->working_time = ($pharmacy->open_time == "00:00:00" && $pharmacy->close_time == "23:59:00")
                    ? "Круглосуточно"
                    : "с {$pharmacy->open_time} до {$pharmacy->close_time}";
                $chPhar->save();
            }
        }
    }
}
