<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'percentage',
        'description',
        'image',
        'category_id', // Make sure to add this for mass assignment
        'subcategory_id', // Make sure to add this for mass assignment
        'brand_id', // Make sure to add this for mass assignment
    ];
    public function product_sub_category(){
        return $this->beLongsTo(ProductSubCategory::class);
    }
    public function product_cat()
    {
        return $this->belongsTo(ProductCat::class);
    }
    public function product_brand(){
        return $this->belongsTo(ProductBrand::class);
    }

}
