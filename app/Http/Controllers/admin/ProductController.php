<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\Unit;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();
        $categories= ProductCat::all();
        $brands= ProductBrand::all();
        $subcategories= ProductSubCategory::all();
        $units = Unit::all();
        return view('admin.pages.products.product', compact('products','categories','brands','subcategories','units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
        'sku' => 'required|string|unique:products',
        'price' => 'required|numeric',
        'product_category' => 'required|integer',
        'sub_category' => 'required|integer',
        'quantity' => 'required|integer',
        'description' => 'required|string',
        'weight' => 'required|numeric',
        'dimensions' => 'required|string',
        'images' => 'required', // Required images field
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Each image must follow this rule
    ]);

    $user = Auth::user();
    $userId = $user ? $user->id : null;

    // Generate slugs
    $slug = Str::slug($request->name, '-');
    $description_slug = Str::slug($request->description, '-');

    // Create a new Product instance
    $product = new Product();
    $product->name = $request->name;
    $product->sku = $request->sku;
    $product->price = $request->price;
    $product->discounted_price = $request->discount_price;
    $product->stock_quantity = $request->quantity;
    $product->product_cat_id = $request->product_category;
    $product->product_sub_category_id = $request->sub_category;
    $product->product_brand_id = $request->brand_id;
    $product->description = $request->description;
    $product->weight = $request->weight;
    $product->unit_id=$request->unit_id;
    $product->dimensions = $request->dimensions;
    $product->color_options = json_encode($request->input('colors'));
    $product->tags = json_encode($request->input('tags'));
    // $product->color_options = $request->input('colors'); // Directly saving JSON string
    // $product->tags = $request->input('tags'); // Directly saving JSON string
    $product->user_id = $userId;
    $product->slug = $slug;
    $product->name_slug = $slug;
    $product->description_slug = $description_slug;
    $product->short_description = $request->short_description;
    $product->shipping_info = $request->shipping_info;

    // Handle multiple image uploads and store as JSON in the database
    $product->images = $this->uploadImages($request); // JSON array of image names
    $product->save();

    return redirect()->route('product.index')->with('success', 'Product added successfully.');
}


    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::with('product_cat', 'product_sub_category', 'product_brand', 'user')
            ->where('id', $id)
            ->get()
            ->map(function ($product) {
                if ($product->images) {
                    $images = json_decode($product->images, true);
                    if (is_array($images) && count($images) > 0) {
                        $product->image = url('images/products/' . basename($images[0]));
                    }
                }
                return $product;
            });
    
        return response()->json($products);
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $products = Product::with('product_cat', 'product_sub_category', 'product_brand', 'user')
            ->where('id', $id)
            ->get()
            ->map(function ($product) {
                if ($product->images) {
                    $images = json_decode($product->images, true);
                    if (is_array($images) && count($images) > 0) {
                        $product->image = url('images/products/' . basename($images[0]));
                    }
                }
                return $product;
            });
    
        return response()->json($products);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'sku' => 'required|string|unique:products',
        //     'price' => 'required|numeric',
        //     'product_category' => 'required|integer',
        //     'sub_category' => 'required|integer',
        //     'quantity' => 'required|integer',
        //     'description' => 'required|string',
        //     'weight' => 'required|numeric',
        //     'dimensions' => 'required|string',
        //     'images' => 'required', // Required images field
        //     'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Each image must follow this rule
        //    ]);
    
        
                // Find the product by ID
                $product = Product::findOrFail($id);
        
                // Update product fields
                $product->name = $request->input('name');
                $product->sku = $request->input('sku');
                $product->product_cat_id = $request->input('product_category');
                $product->product_sub_category_id = $request->input('sub_category');
                $product->product_brand_id = $request->input('brand_id');
                $product->price = $request->input('price');
                $product->discounted_price = $request->input('discount_price');
                $product->stock_quantity = $request->input('stock_quantity');
                $product->short_description = $request->input('short_description');
                $product->description = $request->input('description');
                $product->shipping_info = $request->input('shipping_info');
                $product->weight = $request->input('weight');
                $product->unit_id = $request->input('unit_id');
                $product->dimensions = $request->input('dimensions');
                $product->tags = $request->input('tags');
                $product->color_options = $request->input('colors');
        
                // Handle image uploads (if new images are provided)
                if ($request->hasFile('images')) {
                    $images = [];
                    foreach ($request->file('images') as $image) {
                        $imageName = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('images/products'), $imageName);
                        $images[] = $imageName;
                    }
                    $product->images = json_encode($images);
                }
        
                // Save the updated product
                $product->save();
        
                // Return success response
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product updated successfully',
                    'data' => $product,
                ], 200);
            }
        
    

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Helper function to handle image uploads.
     */
    private function uploadImages($request)
    {
        $images = $request->file('images'); // Get the array of images
        $uploadedImages = [];

        if ($images) {
            foreach ($images as $image) {
                // Generate a unique name for each image
                $imageName = time() . '-' . Str::random(10) . '-' . $image->getClientOriginalName();

                // Move the image to the public directory for product images
                $image->move(public_path('images/products'), $imageName);

                // Add each uploaded image's name to the array
                $uploadedImages[] = $imageName;
            }
        }

        // Return the array of uploaded image names as JSON
        return json_encode($uploadedImages);
    }


    /**
     * Fetch subcategories and brands for the selected category.
     */
    public function getSubcategoriesAndBrands($categoryId)
    {
        $subcategories = ProductSubCategory::where('product_cat_id', $categoryId)->get();
        $brands = ProductBrand::where('product_cat_id', $categoryId)->get();

        return response()->json([
            'subcategories' => $subcategories,
            'brands' => $brands,
        ]);
    }
}
