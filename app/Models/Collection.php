<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Collection extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'slug',
        'is_active',
        'show_on_front',
        'image',
    ];
        public static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->name);
            }
        });
    }

    
public function products()
{
    return $this->belongsToMany(Product::class, 'collection_products')->withTimestamps();
}

}
