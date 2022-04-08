<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DefferedSubscription
 *
 * @property int $id
 * @property string $phone
 * @property string $sponsor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DefferedSubscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DefferedSubscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DefferedSubscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|DefferedSubscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefferedSubscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefferedSubscription wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefferedSubscription whereSponsor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DefferedSubscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DefferedSubscription extends Model
{
    use HasFactory;
}
