<?php

namespace App\Services\Review;

use App\Repositories\Review\RatingRepository;
use App\Repositories\Review\ReviewRepository;

class ProductReviewService
{
    public function __construct(
        private ReviewRepository $reviewRepository,
        private RatingRepository $ratingRepository
    )
    {
    }

    public function create($user, $reviewable, $data) {
        $data['user_id'] = $user->id;
        $data['rating_id'] = $this->ratingRepository->getByValue($data['rating'])->id;

        return $this->reviewRepository->create($reviewable, $data);
    }

    public function list($reviewable) {
        return $this->reviewRepository->getByReviewable($reviewable);
    }
}
