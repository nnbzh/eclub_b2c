<?php

namespace App\Repositories;

use App\Models\Pharmacy;

class PharmacyRepository
{
    public function getBy($column, $value) {
        return Pharmacy::query()->where($column, $value)->get();
    }
}
