<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'address_id',
        'status',
        'delivery_option_id',
        'payment_option_id',
        'total_price',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function deliveryOption()
    {
        return $this->belongsTo(DeliveryOption::class);
    }

    public function paymentOption()
    {
        return $this->belongsTo(PaymentOption::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
