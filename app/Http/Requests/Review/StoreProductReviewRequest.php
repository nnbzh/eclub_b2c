<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductReviewRequest extends FormRequest
{
    public function rules() {
        return [
            'rating'    => 'required|integer|gte:1|lte:5',
            'comment'   => 'nullable|string'
        ];
    }
}
