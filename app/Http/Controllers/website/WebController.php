<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function home(){
        $product=Product::all();
        return view('website.index',compact('product'));
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
