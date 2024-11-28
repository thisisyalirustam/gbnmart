<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'delivered_date' => 'datetime',
    ];
    protected $fillable = [
        'user_id',
        'subtotal',
        'shipping',
        'coupon_code',
        'discount',
        'grand_total',
        'name',
        'email',
        'phone',
        'country_id',
        'address',
        'apartment',
        'city',
        'state',
        'zip',
        'note',
        'payment_method',
        'bank_invoice',
        'shipping_status',
        'delivered_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
