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
    public function home()
    {
        $product = Product::where('status', 'active')->where('sof', 'Yes')->take(8)->get();
        $category = ProductCat::where('status', '1')->where('sof', 'yes')->get();
        return view('website.index', compact('product', 'category'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->with('product_cat')->firstOrFail();
        $relatedProducts = Product::where('product_sub_category_id', $product->product_sub_category_id)->get();
        $images = json_decode($product->images);
        $colors = json_decode($product->color_options);

        $data = [
            'product' => $product,
            'images' => $images,
            'colors' => $colors,
            'related' => $relatedProducts
        ];

        return view('website.product', $data);
    }




    public function admin()
    {
        return view('admin.pages.dashboard.index');
    }

    public function shop(Request $request, $catslug = null, $subcatslug = null)
    {

        $categories = ProductCat::orderBy('name', 'ASC')
            ->with('product_sub_category')
            ->where('status', 1)
            ->get();

        $brands = ProductBrand::orderBy('name', 'ASC')->get();

        $products = Product::where('status', 'active')
            ->where('sof', 'Yes');
        if (!empty($catslug)) {
            $category = ProductCat::where('slug', $catslug)->first();
            if ($category) {
                $products = $products->where('product_cat_id', $category->id);
            }
        }
        if (!empty($subcatslug)) {
            $subcategory = ProductSubCategory::where('slug', $subcatslug)->first();
            if ($subcategory) {
                $products = $products->where('product_sub_category_id', $subcategory->id);
            }
        }
        $brandsArray = [];
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('product_brand_id', $brandsArray);
        }

        $maxPriceProduct = Product::max('discounted_price');
        $min_price = intval($request->input('minprice', 0));
        $max_price = intval($request->input('maxprice', $maxPriceProduct));
        $sort = $request->get('sort');
        $products = $products->whereBetween('discounted_price', [$min_price, $max_price]);

        if ($request->get('sort') != '') {
            if ($request->get('sort') == 'latest_product') {
                $products = $products->orderBy('id', 'DESC');
            } else if ($request->get('sort') == 'price_high') {
                $products = $products->orderBy('discounted_price', 'DESC');
            } else if ($request->get('sort') == 'price_low') {
                $products = $products->orderBy('discounted_price', 'ASC');
            }
        } else {
            $products = $products->orderBy('id', 'DESC');
        }
        $products = $products->orderBy('id', 'DESC')->get();


        return view('website.shop', compact('categories', 'brands', 'products', 'brandsArray', 'min_price', 'max_price', 'maxPriceProduct', 'sort'));
    }

    
}
