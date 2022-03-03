<?php

namespace App\Repositories\Review;

class ReviewRepository
{
    public function getByReviewable($reviewable) {
        return $reviewable->reviews()->simplePaginate();
    }

    public function create($reviewable, $data) {
        return $reviewable->reviews()->create($data);
    }
}
