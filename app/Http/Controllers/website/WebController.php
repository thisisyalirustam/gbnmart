<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCat;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function home(){
        $product=Product::all();
        $category=ProductCat::where('status','1')->where('sof','yes')->get();
        return view('website.index',compact('product','category'));
    }

    public function productDetail($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    return view('website.product-detail', compact('product'));
}

    public function admin(){
        return view('admin.pages.dashboard.index');
    }
}
