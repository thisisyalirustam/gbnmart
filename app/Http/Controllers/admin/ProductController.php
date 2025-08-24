<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\Unit;
use Dotenv\Validator;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return [
            new Middleware('permission:product.view', only: ['index']),
            new Middleware('permission:product.view', only: ['show']),
            new Middleware('permission:product.create', only: ['store']),
            new Middleware('permission:product.update', only: ['update']),
            new Middleware('permission:product.delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();
        $categories = ProductCat::all();
        $brands = ProductBrand::all();
        $subcategories = ProductSubCategory::all();
        $units = Unit::all();
        $collections = Collection::all();
        return view('admin.pages.products.product', compact('products', 'categories', 'brands', 'subcategories', 'units','collections'));
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120' // Each image must follow this rule
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
        $product->unit_id = $request->unit_id;
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

        return response()->json(['success' => true, 'message' => 'Product Added Successfully']);
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

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $id,
            'price' => 'required|numeric',
            'product_category' => 'required|integer',
            'sub_category' => 'required|integer',
            'quantity' => 'integer',
            'description' => 'required|string',
            'weight' => 'required|numeric',
            'dimensions' => 'required|string',
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate new images
        ]);
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
        $product->tags = json_encode($request->input('tags'));
        $product->color_options = json_encode($request->input('colors'));
        $existingImages = json_decode($product->images, true) ?? [];

        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $deletedImage) {
                $imagePath = public_path('images/products/' . $deletedImage);
                if (file_exists($imagePath)) {
                    unlink($imagePath);  // Delete the image
                }
                $existingImages = array_diff($existingImages, [$deletedImage]);
            }
        }
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();  // Get the original file name
                $destinationPath = public_path('images/products');  // Folder in public directory
                $image->move($destinationPath, $imageName);
                $uploadedImages[] = $imageName;
            }
            $existingImages = array_merge($existingImages, $uploadedImages);
        }
        $product->images = json_encode(array_values($existingImages));
        $product->save();
        return response()->json(['success' => true, 'message' => 'Product updated successfully']);
    }



    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Get the associated images from the product (assuming they are stored as a JSON array in the 'images' column)
        $images = json_decode($product->images, true);

        // Check if images exist and delete them from the storage
        if ($images && is_array($images)) {
            foreach ($images as $image) {
                $imagePath = public_path('images/products/' . $image); // Get the full path to the image file

                // Check if the image exists and delete it using PHP's unlink
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Delete the file
                }
            }
        }

        // Delete the product from the database
        $product->delete();

        return response()->json(['success' => true, 'message' => 'Product Delete Successfully.']);
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

    public function deleteImage(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Get the image name from the request
        $imageName = $request->input('image');

        // Define the path to the image in the public folder
        $imagePath = public_path('images/products/' . $imageName);

        // Remove the image from the public folder if it exists
        if (file_exists($imagePath)) {
            unlink($imagePath);  // Delete the image
        }

        // Remove the image from the database
        $existingImages = json_decode($product->images, true) ?? [];
        $existingImages = array_diff($existingImages, [$imageName]);

        // Update the product's images
        $product->images = json_encode(array_values($existingImages));
        $product->save();

        // Return success response
        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }

    // In your ProductController or a dedicated CollectionAssignmentController


}
