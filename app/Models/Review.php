<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'reviewable_id',
        'reviewable_type',
        'comment',
        'rating_id',
        'user_id',
    ];

    public function reviewable() {
        return $this->morphTo();
    }

    public function messages() {
        return $this->belongsToMany(RatingMessage::class, 'review_rating_message');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rating() {
        return $this->belongsTo(Rating::class);
    }

    public function ratingMessages() {
        return $this->belongsToMany(RatingMessage::class, 'review_rating_message');
    }
}
