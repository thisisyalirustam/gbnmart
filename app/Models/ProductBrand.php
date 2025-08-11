<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',             // Slug attribute
        'product_cat_id',
        'user_id',          // Foreign key to User, if applicable
        'website',          // Optional attributes
        'contact_email',
        'contact_phone',
        'description'
    ];

    /**
     * Boot method to automatically set the slug.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($productBrand) {
            $productBrand->slug = Str::slug($productBrand->name);
        });

        static::updating(function ($productBrand) {
            if ($productBrand->isDirty('name')) {
                $productBrand->slug = Str::slug($productBrand->name);
            }
        });
    }

    public function product_cat()
    {
        return $this->belongsTo(ProductCat::class);
    }

}
