<?php

namespace App\Repositories\Review;

use App\Models\Rating;

class RatingRepository
{
    public function getByValue($value) {
        return Rating::query()->where('rating', $value)->first();
    }
}
