<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Banner::with(['product_cat', 'product_sub_category', 'product_brand'])->get();
    $categories = ProductCat::all();
    $subcategories = ProductSubCategory::all();
    $brands = ProductBrand::all();
        return view('admin.pages.settings.banner',compact('products', 'categories', 'subcategories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'percentage' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:product_cats,id',
            'subcategory_id' => 'nullable|exists:product_sub_categories,id',
            'brand_id' => 'nullable|exists:product_brands,id',
        ]);

        // Create a new Banner instance
        $banner = new Banner();
        $banner->title = $validated['title'];
        $banner->percentage = $validated['percentage'];
        $banner->description = $validated['description'];

        if ($request->hasFile('image')) {
            // Get the file from the request
            $img = $request->file('image');

            // Get the file extension
            $ext = $img->getClientOriginalExtension();

            // Define the new image name using the current time (to avoid conflicts)
            $imageName = time() . '.' . $ext;

            // Move the image to the public/images/category_img directory
            $img->move(public_path('images/banners'), $imageName);

            // Save the image path (relative to the public folder)
            $imagePath = 'images/banners/' . $imageName;

            // Store the image path in the database
            $banner->image = $imagePath;
        }

        // Store other fields
        $banner->product_cat_id = $validated['category_id'];
        $banner->product_sub_category_id = $validated['subcategory_id'];
        $banner->product_brand_id = $validated['brand_id'];

        // Save the banner to the database
        $banner->save();

        // Return a success response as JSON
        return response()->json([
            'success' => true,
            'message' => 'Banner created successfully!',
            'data' => $banner // Return the banner data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
