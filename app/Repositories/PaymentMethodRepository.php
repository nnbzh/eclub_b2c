<?php

namespace App\Repositories;

use App\Models\PaymentMethod;

class PaymentMethodRepository
{
    public function list($cityId) {
        return PaymentMethod::query()
            ->whereHas('cities', fn($query) => $query->where('id', $cityId))
            ->where('is_active', true)
            ->get()
            ;
    }
}
