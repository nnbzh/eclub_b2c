<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderReviewRequest extends FormRequest
{
    public function rules() {
        return [
            'rating'            => 'required|integer|gte:1|lte:5',
            'rating_messages'   => 'nullable|array',
            'rating_messages.*' => 'required|int|exists:rating_messages,id',
            'comment'           => 'nullable|string'
        ];
    }
}
