<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'content',
        'slug',
        'images',
        'is_published',
        'published_at',
        'product_cat_id', // Foreign key for ProductCat
        'user_id', // Foreign key for User
        'product_ids',
    ];

    protected $casts = [
        'images' => 'array',
        'product_ids' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relationships
    public function product_cat()
{
    return $this->belongsTo(ProductCat::class, 'product_cat_id');
}


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
