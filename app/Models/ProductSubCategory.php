<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    protected $fillable = [
         'product_cat_id',
        'name'
    ];
    use HasFactory;
    public function product_cat()
    {
        return $this->belongsTo(ProductCat::class);
    }
    
}
