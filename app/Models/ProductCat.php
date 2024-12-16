<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCat extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'status', 'image', 'sof'
    ];

    /**
     * Boot method to automatically set the slug.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($productCat) {
            $productCat->slug = Str::slug($productCat->name);
        });

        static::updating(function ($productCat) {
            if ($productCat->isDirty('name')) {
                $productCat->slug = Str::slug($productCat->name);
            }
        });
    }

    public function product_sub_category()
    {
        return $this->hasMany(ProductSubCategory::class);
    }

    public function banners()
    {
        return $this->hasMany(Banner::class); // The inverse of the 'belongsTo' relationship
    }
}
