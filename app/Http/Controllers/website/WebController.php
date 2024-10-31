<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function home(){
        $product=Product::where('status','active')->where('sof','Yes')->take(8)->get();
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

    public function shop(Request $request, $catslug = null, $subcatslug = null)
    {
        // Retrieve all categories and brands for the filter UI
        $categories = ProductCat::orderBy('name', 'ASC')
            ->with('product_sub_category')
            ->where('status', 1)
            ->get();

        $brands = ProductBrand::orderBy('name', 'ASC')->get();

        // Initialize products query
        $products = Product::where('status', 'active')
            ->where('sof', 'Yes');

        // Filter by category if category slug is provided
        if (!empty($catslug)) {
            $category = ProductCat::where('slug', $catslug)->first();
            if ($category) {
                $products = $products->where('product_cat_id', $category->id);
            }
        }

        // Filter by subcategory if subcategory slug is provided
        if (!empty($subcatslug)) {
            $subcategory = ProductSubCategory::where('slug', $subcatslug)->first();
            if ($subcategory) {
                $products = $products->where('product_sub_category_id', $subcategory->id);
            }
        }

        // Retrieve products after all conditions are applied
        $products = $products->get();

        // Fetch additional sections
        $latestProducts = Product::where('status', 'active')
            ->where('sof', 'Yes')
            ->orderBy('id', 'DESC')
            ->take(8)
            ->get();

        $slideProduct = Product::where('status', 'active')
            ->where('sof', 'Yes')
            ->orderBy('id', 'DESC')
            ->take(3)
            ->get();

        return view('website.shop', compact('categories', 'brands', 'products', 'latestProducts', 'slideProduct'));
    }


}
