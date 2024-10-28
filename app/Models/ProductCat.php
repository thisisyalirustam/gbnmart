<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    protected $fillable = [
        'name','status', 'image', 'sof'
    ];
    use HasFactory;
}
