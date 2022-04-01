<?php

namespace App\Services\Review;

use App\Repositories\Review\RatingRepository;
use App\Repositories\Review\ReviewRepository;

class ReviewService
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
        $review = $this->reviewRepository->create($reviewable, $data);

        if (! empty($data['rating_messages'])) {
            $review->ratingMessages()->sync($data['rating_messages']);
        }

        return $review;
    }

    public function list($reviewable) {
        return $this->reviewRepository->getByReviewable($reviewable);
    }
}
