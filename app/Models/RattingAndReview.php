<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RattingAndReview extends Model
{
    //
    protected $table = 'ratings_and_reviews';

    protected $fillable = [
        'order_item_id',
        'reviewer_name',
        'reviewer_email',
        'rating',
        'review',
        'status',
    ];

    // Define the relationship to the order item
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
    
}
