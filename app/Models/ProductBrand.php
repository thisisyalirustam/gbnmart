<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'product_cat_id'
    ];

    public function product_cat()
    {
        return $this->belongsTo(ProductCat::class);
    }
}
