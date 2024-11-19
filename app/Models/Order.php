<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
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
    ];
}
