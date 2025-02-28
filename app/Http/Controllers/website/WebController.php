<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\RattingAndReview;
use Illuminate\Http\Request;

class WebController extends Controller
{
    //
    public function home()
    {
        $product = Product::with('product_cat')->where('status', 'active')->where('sof', 'Yes')->take(8)->get();
        $category = ProductCat::where('status', '1')->where('sof', 'yes')->get();
        return view('website.index', compact('product', 'category'));
    }

    public function productDetail($slug)
    {
        // Fetch the product by slug
        $product = Product::where('slug', $slug)->with('product_cat')->firstOrFail();
        
        // Get related products based on the product's sub-category
        $relatedProducts = Product::where('product_sub_category_id', $product->product_sub_category_id)->get();
        
        // Decode product images and color options
        $images = json_decode($product->images);
        $colors = json_decode($product->color_options);
        
        // Fetch the ratings and reviews for the current product
        $ratingandreview = RattingAndReview::with(['orderItem.product', 'orderItem.order'])
            ->whereHas('orderItem.product', function($query) use ($slug) {
                $query->where('slug', $slug);  // Filter reviews by product slug
            })
            ->orderBy('created_at', 'desc')->where('status',1)
            ->get();
        // Fetch the ratings and reviews for the current product
        $ratingandreviewcount = RattingAndReview::with(['orderItem.product', 'orderItem.order'])
            ->whereHas('orderItem.product', function($query) use ($slug) {
                $query->where('slug', $slug);  // Filter reviews by product slug
            })
            ->orderBy('created_at', 'desc')->where('status',1)
            ->count();
    
        // Prepare the data to pass to the view
        $data = [
            'product' => $product,
            'images' => $images,
            'colors' => $colors,
            'related' => $relatedProducts,
            'ratingandreview' => $ratingandreview, 
            'ratingandreviewcount'=>$ratingandreviewcount // Pass the ratings/reviews data to the view
        ];
    
        // Return the view with the product data and ratings
        return view('website.product', $data);
    }
    




    public function admin()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(12);
    
        // Get the top-rated products with the additional sold count and revenue calculations
        $topRatedProduct = RattingAndReview::with('orderItem.product')
            ->selectRaw('
                products.id as product_id, 
                products.name as product_name, 
                products.price as product_price,
                COUNT(ratings_and_reviews.rating) as review_count, 
                AVG(ratings_and_reviews.rating) as average_rating, 
                products.images as product_images,
                SUM(order_items.quantity) as sold_quantity, 
                SUM(order_items.quantity * order_items.price) as revenue
            ')
            ->join('order_items', 'order_items.id', '=', 'ratings_and_reviews.order_item_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.shipping_status', 'Complete') // Only count completed orders
            ->groupBy('products.id', 'products.name','products.price', 'products.images') // Group by all non-aggregated columns
            ->orderByDesc('average_rating')
            ->get();
    
        return view('admin.pages.dashboard.index', compact('orders', 'topRatedProduct'));
    }
    


    public function shop(Request $request, $catslug = null, $subcatslug = null)
    {

        $catSelected='';
        $subCatSelected='';

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
                $catSelected=$category->id;
            }
        }
        if (!empty($subcatslug)) {
            $subcategory = ProductSubCategory::where('slug', $subcatslug)->first();
            if ($subcategory) {
                $products = $products->where('product_sub_category_id', $subcategory->id);
                $subCatSelected= $subcategory->id;
            }
        }
        $brandsArray = [];
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $products = $products->whereIn('product_brand_id', $brandsArray);
        }

        if(!empty($request->get('search'))){
            $products=$products->where('name','like','%'.$request->get('search').'%');
        }

        $maxPriceProduct = Product::max('price');
        $min_price = intval($request->input('minprice', 0));
        $max_price = intval($request->input('maxprice', $maxPriceProduct));
        $sort = $request->get('sort');

        $products = $products->whereBetween('price', [$min_price, $max_price]);

        if ($request->get('sort') != '') {
            if ($request->get('sort') == 'latest_product') {
                $products = $products->orderBy('id', 'DESC');
            } else if ($request->get('sort') == 'price_high') {
                $products = $products->orderBy('price', 'DESC');
            } else if ($request->get('sort') == 'price_low') {
                $products = $products->orderBy('price', 'ASC');
            }
        } else {
            $products = $products->orderBy('id', 'DESC');
        }
        $products = $products->orderBy('id', 'DESC')->get();


        return view('website.shop', compact('categories', 'brands', 'products', 'brandsArray', 'min_price', 'max_price', 'maxPriceProduct', 'sort','catSelected','subCatSelected'));
    }


}
