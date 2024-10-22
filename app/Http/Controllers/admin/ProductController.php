<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductSubCategory;
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
        return view('admin.pages.products.product', compact('products'));
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
        $product->dimensions = $request->dimensions;
        $product->color_options = json_encode($request->input('colors'));
        $product->tags = json_encode($request->input('tags'));
        $product->user_id = $userId;
        $product->slug = $slug;
        $product->name_slug = $slug;
        $product->description_slug = $description_slug;

        // Handle the image uploads
        $product->images = $this->uploadImages($request);

        // Save the product
        $product->save();

        return redirect()->route('product.index')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $id,
            'price' => 'required|numeric',
            'product_category' => 'required|integer',
            'sub_category' => 'required|integer',
            'quantity' => 'required|integer',
            'description' => 'required|string',
            'weight' => 'required|numeric',
            'dimensions' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        // Update the product
        $product->update([
            'name' => $request->name,
            'sku' => $request->sku,
            'price' => $request->price,
            'discounted_price' => $request->discount_price,
            'stock_quantity' => $request->quantity,
            'product_cat_id' => $request->product_category,
            'product_sub_category_id' => $request->sub_category,
            'description' => $request->description,
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
            'colors' => json_encode($request->input('colors')),
            'images' => $this->uploadImages($request),
        ]);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
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
                $imageName = time() . '-' . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $imageName);
                $uploadedImages[] = $imageName;
            }
        }

        return json_encode($uploadedImages); // Store as JSON array in database
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
