<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Review
 *
 * @property int $id
 * @property string $reviewable_type
 * @property int $reviewable_id
 * @property string|null $comment
 * @property int|null $rating_id
 * @property int|null $user_id
 * @property int $is_processed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RatingMessage[] $messages
 * @property-read int|null $messages_count
 * @property-read \App\Models\Rating|null $rating
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RatingMessage[] $ratingMessages
 * @property-read int|null $rating_messages_count
 * @property-read Model|\Eloquent $reviewable
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereIsProcessed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereRatingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReviewableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereReviewableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUserId($value)
 * @mixin \Eloquent
 */
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
