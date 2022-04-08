<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Bankcard
 *
 * @property int $id
 * @property string $number
 * @property int|null $user_id
 * @property string|null $month
 * @property string|null $year
 * @property string|null $bank
 * @property string|null $country
 * @property string|null $status
 * @property int|null $card_id
 * @property string $recurring_profile_id
 * @property string $provider
 * @property int $has_3ds
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereHas3ds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereRecurringProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bankcard whereYear($value)
 * @mixin \Eloquent
 */
class Bankcard extends Model
{
    protected $fillable = [
        'number',
        'user_id',
        'month',
        'year',
        'bank',
        'country',
        'status',
        'card_id',
        'recurring_profile_id',
        'provider',
        'has_3ds',
    ];
}
