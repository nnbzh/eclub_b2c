<?php

namespace App\Models;

use App\Models\Interfaces\IBillable;
use App\Traits\Billable;
use App\Traits\HasFilters;
use App\Traits\Reviewable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int|null $number
 * @property string $status
 * @property int $user_id
 * @property array|null $address
 * @property int|null $pharmacy_id
 * @property int|null $payment_method_id
 * @property int|null $delivery_method_id
 * @property string|null $customer_name
 * @property string|null $customer_phone
 * @property string|null $comment
 * @property int|null $cost
 * @property int $used_bonuses
 * @property int $delivery_cost
 * @property array|null $fields_json
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cancellation|null $cancellation
 * @property-read \App\Models\DeliveryMethod|null $deliveryMethod
 * @property-read \App\Models\PaymentMethod|null $paymentMethod
 * @property-read \App\Models\Pharmacy|null $pharmacy
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @property-read \App\Models\Review|null $review
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \App\Models\Transaction|null $transaction
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCustomerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereFieldsJson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePharmacyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUsedBonuses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
class Order extends Model implements IBillable
{
    use Billable, Reviewable, HasFilters, CrudTrait;

    protected $fillable = [
        'number',
        'user_id',
        'pharmacy_id',
        'payment_method_id',
        'delivery_method_id',
        'customer_name',
        'customer_phone',
        'comment',
        'cost',
        'used_bonuses',
        'delivery_cost',
        'status',
        'fields_json',
        'address'
    ];

    protected $casts = [
        'fields_json'   => 'array',
        'address'       => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function deliveryMethod() {
        return $this->belongsTo(DeliveryMethod::class);
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function pharmacy() {
        return $this->belongsTo(Pharmacy::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class, 'order_product')
            ->withPivot('quantity', 'price');
    }

    public function cancellation() {
        return $this->hasOne(Cancellation::class);
    }

    public function courier() {
        return $this->hasOne(Courier::class);
    }
}
