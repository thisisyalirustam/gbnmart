<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{

    use HasFactory;
    protected $fillable = [
        'user_id',
        'bank_details',
        'coupon',
        'status',
        'percentage',
        'membership_tier',
        'sales',
        'amount',
        'withdrawal',
    ];

    protected $casts = [
        'bank_details' => 'array', // Cast the bank_details field to an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
