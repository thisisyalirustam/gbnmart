<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'name_slug', 'slug', 'description', 'description_slug', 'product_cat_id', 'product_sub_category_id',
        'sku', 'price', 'discounted_price', 'stock_quantity', 'product_brand_id', 'user_id', 'supplier_id', 'weight', 'dimensions',  'color_options',
        'size_options', 'material', 'images', 'rating','reviews', 'shipping_info','return_policy', 'tags',
        'featured', 'created_at', 'updated_at', 'deleted_at'
    ];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $product->name_slug = Str::slug($product->name);
            $product->slug = static::generateUniqueSlug($product->name, $product->id);
            if (!empty($product->description)) {
                $product->description_slug = Str::slug($product->description);
            } else {
                $product->description_slug = null;
            }
        });
    }

    /**
     * Generates a unique slug for the product.
     *
     * @param string $name
     * @param int|null $productId
     * @return string
     */
    public static function generateUniqueSlug($name, $productId = null)
    {
        $slug = Str::slug($name);
        $slugExists = Product::where('slug', $slug)->where('id', '<>', $productId)->exists();
        $originalSlug = $slug;
        $i = 1;
        while ($slugExists) {
            $slug = $originalSlug . '-' . $i++;
            $slugExists = Product::where('slug', $slug)->where('id', '<>', $productId)->exists();
        }

        return $slug;
    }
}
