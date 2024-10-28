<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.pages.dashboard.index');
    }
    public function showuser()
    {
        $users = User::all()->map(function ($user) {
            if ($user->image) {
                // Ensure the image URL is correct
                $user->image = url('uploads/' . $user->image);
            }
            return $user;
        });

        return response()->json($users);
    }
    public function showproductcat()
    {
        $product_cat = ProductCat::orderBy('id', 'DESC')->get()->map(function ($category) {
            if ($category->image) {
                // Ensure that only the filename is appended to the base URL
                $category->image = url('images/category_img/' . basename($category->image));
            }
            return $category;
        });

        return response()->json($product_cat);
    }


    public function product_sub_cat()
    {
        $product_sub_cat = ProductSubCategory::with('product_cat')->get();
        return response()->json($product_sub_cat);
    }

    public function product_brand()
    {
        $brand = ProductBrand::with('product_cat')->get();
        return response()->json($brand);
    }
    public function product()
    {

        $products = Product::with('product_cat', 'product_sub_category', 'product_brand', 'user')
            ->get()
            ->map(function ($product) {
                if ($product->images) {
                    // Decode the JSON images data
                    $images = json_decode($product->images, true);

                    // Check if images is not empty and is an array
                    if (is_array($images) && count($images) > 0) {
                        // Set the first image from the images array
                        $product->image = url('images/products/' . basename($images[0]));
                    }
                }
                return $product;
            });

        return response()->json($products);
    }
}
