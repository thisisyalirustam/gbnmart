<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        return view('admin.pages.dashboard.index');
    }
    public function showuser(){
        $users = User::all()->map(function ($user) {
            if ($user->image) {
                // Ensure the image URL is correct
                $user->image = url('uploads/' . $user->image);
            }
            return $user;
        });
    
        return response()->json($users);
    }
    public function showproductcat(){
        $product_cat = ProductCat::all();
        return response()->json( $product_cat);
    }
    public function product_sub_cat(){
        $product_sub_cat = ProductSubCategory::with('product_cat')->get();
        return response()->json($product_sub_cat);        
    }
    
    public function product_brand(){
        $brand = ProductBrand::all();
        return response()->json($brand);    
    }
    public function product(){
        
    }
}
