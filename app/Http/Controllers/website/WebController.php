<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Collection;
use App\Models\Notification;
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

    public function home()
    {
        $product = Product::with('product_cat')
            ->where('status', 'active')
            ->where('sof', 'Yes')
            ->take(8)->orderBy('id', 'DESC')
            ->get();

        $sellproduct = Product::with('product_cat')
            ->where('status', 'active')
            ->where('sof', 'Yes')
            ->whereNotNull('discounted_price')
            ->take(8)->orderBy('id', 'DESC')
            ->get();

        $category = ProductCat::where('status', '1')
            ->where('sof', 'yes')
            ->get();

        $frontCategory = ProductCat::where('status', 1)
            ->where('sof', 'yes')->take(5)
            ->with([
                'product_sub_category' => function ($query) {
                    $query->limit(3);
                }
            ])
            ->get();

        $collections = Collection::where('is_active', 1)
            ->where('show_on_front', 1)
            ->withCount('products')
            ->get();

        // Combine product IDs from both product sets
        $productIds = $product->pluck('id')->merge($sellproduct->pluck('id'))->unique()->toArray();

        $ratingData = RattingAndReview::selectRaw('order_items.product_id, AVG(ratings_and_reviews.rating) as avg_rating, COUNT(*) as rating_count')
            ->join('order_items', 'ratings_and_reviews.order_item_id', '=', 'order_items.id')
            ->whereIn('order_items.product_id', $productIds)
            ->where('ratings_and_reviews.status', 1)
            ->groupBy('order_items.product_id')
            ->get()
            ->keyBy('product_id');

            $blogs=Blog::where('is_published',1)->take(4)->get();

             $topRatedProduct = RattingAndReview::with('orderItem.product')
    ->selectRaw('
        products.id as product_id, 
        products.name as product_name, 
        products.slug as product_slug, 
        products.price as product_price,
        COUNT(ratings_and_reviews.rating) as review_count, 
        AVG(ratings_and_reviews.rating) as average_rating, 
        products.images as product_images,
        SUM(order_items.quantity) as sold_quantity
    ')
    ->join('order_items', 'order_items.id', '=', 'ratings_and_reviews.order_item_id')
    ->join('products', 'products.id', '=', 'order_items.product_id')
    ->join('orders', 'orders.id', '=', 'order_items.order_id')
    ->where('orders.shipping_status', 'Complete')
    ->groupBy('products.id', 'products.name', 'products.slug', 'products.price', 'products.images')
    ->orderByDesc('average_rating')
    ->get();


        return view('website.index', compact('product', 'category', 'frontCategory', 'collections', 'sellproduct', 'ratingData','blogs','topRatedProduct'));
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
            ->whereHas('orderItem.product', function ($query) use ($slug) {
                $query->where('slug', $slug);  // Filter reviews by product slug
            })
            ->orderBy('created_at', 'desc')->where('status', 1)
            ->get();
        // Fetch the ratings and reviews for the current product
        $ratingandreviewcount = RattingAndReview::with(['orderItem.product', 'orderItem.order'])
            ->whereHas('orderItem.product', function ($query) use ($slug) {
                $query->where('slug', $slug);  // Filter reviews by product slug
            })
            ->orderBy('created_at', 'desc')->where('status', 1)
            ->count();

        // Prepare the data to pass to the view
        $data = [
            'product' => $product,
            'images' => $images,
            'colors' => $colors,
            'related' => $relatedProducts,
            'ratingandreview' => $ratingandreview,
            'ratingandreviewcount' => $ratingandreviewcount // Pass the ratings/reviews data to the view
        ];

        // Return the view with the product data and ratings
        return view('website.product', $data);
    }
    public function shop(Request $request, $catslug = null, $subcatslug = null)
    {
        $catSelected = '';
        $subCatSelected = '';

        // Get categories with subcategories
        $categories = ProductCat::orderBy('name', 'ASC')
            ->with('product_sub_category')
            ->where('status', 1)
            ->get();

        // Get all brands
       
        // Start building the product query
        $productsQuery = Product::where('status', 'active')
            ->where('sof', 'Yes');

             $brands = ProductBrand::orderBy('name', 'ASC')->get();


        // Apply category filter if exists
        if (!empty($catslug)) {
            $category = ProductCat::where('slug', $catslug)->first();
            if ($category) {
                $productsQuery->where('product_cat_id', $category->id);
                $catSelected = $category->id;
            }
        }

        // Apply subcategory filter if exists
        if (!empty($subcatslug)) {
            $subcategory = ProductSubCategory::where('slug', $subcatslug)->first();
            if ($subcategory) {
                $productsQuery->where('product_sub_category_id', $subcategory->id);
                $subCatSelected = $subcategory->id;
            }
        }

        // Handle brand filter
        $brandsArray = [];
        if (!empty($request->get('brand'))) {
            $brandsArray = explode(',', $request->get('brand'));
            $productsQuery->whereIn('product_brand_id', $brandsArray);
        }

        // Handle search
        if (!empty($request->get('search'))) {
            $productsQuery->where('name', 'like', '%' . $request->get('search') . '%');
        }

        // Price range handling
        $maxPriceProduct = Product::max('price');
        $min_price = intval($request->input('minprice', 0));
        $max_price = intval($request->input('maxprice', $maxPriceProduct));
        $productsQuery->whereBetween('price', [$min_price, $max_price]);

        // Sorting
        $sort = $request->get('sort');
        switch ($sort) {
            case 'price_high':
                $productsQuery->orderBy('price', 'DESC');
                break;
            case 'price_low':
                $productsQuery->orderBy('price', 'ASC');
                break;
            case 'latest_product':
            default:
                $productsQuery->orderBy('id', 'DESC');
        }

        // Pagination
        $perPage = $request->get('per_page', 12); // Default to 12 items per page
        $products = $productsQuery->paginate($perPage);

        // Get product IDs for rating data
        $productIds = $products->pluck('id')->toArray();

        // Get rating data
        $ratingData = RattingAndReview::selectRaw('order_items.product_id, AVG(ratings_and_reviews.rating) as avg_rating, COUNT(*) as rating_count')
            ->join('order_items', 'ratings_and_reviews.order_item_id', '=', 'order_items.id')
            ->whereIn('order_items.product_id', $productIds)
            ->where('ratings_and_reviews.status', 1)
            ->groupBy('order_items.product_id')
            ->get()
            ->keyBy('product_id');

        return view('website.shop', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'brandsArray' => $brandsArray,
            'min_price' => $min_price,
            'max_price' => $max_price,
            'maxPriceProduct' => $maxPriceProduct,
            'sort' => $sort,
            'catSelected' => $catSelected,
            'subCatSelected' => $subCatSelected,
            'ratingData' => $ratingData,
        ]);
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
            ->groupBy('products.id', 'products.name', 'products.price', 'products.images') // Group by all non-aggregated columns
            ->orderByDesc('average_rating')
            ->get();

        $notifications = Notification::latest()->take(8)->get();

        return view('admin.pages.dashboard.index', compact('orders', 'topRatedProduct', 'notifications'));
    }
    public function showPassword()
    {
        return view('profile.update');
    }
    public function collectionProduct($slug)
    {
        $collection_product = Collection::with('products')->where('slug', $slug)->firstOrFail();
        $productIds = $collection_product->products->pluck('id')->toArray();

        $ratingData = RattingAndReview::selectRaw('order_items.product_id, AVG(ratings_and_reviews.rating) as avg_rating, COUNT(*) as rating_count')
            ->join('order_items', 'ratings_and_reviews.order_item_id', '=', 'order_items.id')
            ->whereIn('order_items.product_id', $productIds)
            ->where('ratings_and_reviews.status', 1)
            ->groupBy('order_items.product_id')
            ->get()
            ->keyBy('product_id');

        // Pass ratingData to the view
        return view('website.collection_products', compact('collection_product', 'ratingData'));
    }

    public function contactus()
    {

        return view('website.contact');
    }

    public function blogshow($slug){
    $blog=Blog::with('user','product_cat')->where('slug',$slug)->first();
    $relatedBlogs=Blog::with('user','product_cat')->where('product_cat_id',$blog->product_cat_id)->where('is_published',1)->whereNot('slug',$slug)->get();
    return view('website.blogshow',compact('blog','relatedBlogs'));
    }
    public function blogs()
{
    $blogs = Blog::with('user', 'product_cat')
                ->where('is_published', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(9); // 9 blogs per page
    
    return view('website.blogs', compact('blogs'));
}

public function aboutus(){
    return view('website.about');
}

public function returnPolicy($id){
    $returnpolicy=Order::where('id',$id)->first();
    return view('website.returnpolicy',compact('returnpolicy'));
}
}
