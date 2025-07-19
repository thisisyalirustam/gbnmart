<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_cat_id',
        'name',
        'slug',
        'image'// Include slug in fillable attributes
    ];

    /**
     * Boot method to automatically set the slug.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($productSubCategory) {
            $productSubCategory->slug = Str::slug($productSubCategory->name);
        });

        static::updating(function ($productSubCategory) {
            if ($productSubCategory->isDirty('name')) {
                $productSubCategory->slug = Str::slug($productSubCategory->name);
            }
        });
    }

    public function product_cat()
    {
        return $this->belongsTo(ProductCat::class);
    }
}
