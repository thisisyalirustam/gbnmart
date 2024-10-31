<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_cat = ProductCat::all();
        return view('admin.pages.products.products_cat', compact('product_cat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
            'sof' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $ext = $img->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $img->move(public_path('images/category_img'), $imageName);
            $imagePath = 'images/category_img/' . $imageName;
        }

        // Create the category
        $productCat = ProductCat::create([
            'name' => $request->input('name'),
            'status' => $request->input('status'),
            'sof' => $request->input('sof'),
            'image' => $imagePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product category created successfully',
            'product' => $productCat
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = ProductCat::select('id', 'name', 'status', 'sof', 'image')
            ->where(['id' => $id])
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Your beautiful user',
            'product' => $product
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Additional code for editing can be implemented here if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'status' => 'required|boolean',
                'sof' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $productCat = ProductCat::findOrFail($id);

            // Update the fields
            $productCat->name = $request->input('name');
            $productCat->status = $request->input('status');
            $productCat->sof = $request->input('sof');

            // Handle image update
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($productCat->image && file_exists(public_path($productCat->image))) {
                    unlink(public_path($productCat->image));
                }

                // Save the new image
                $img = $request->file('image');
                $ext = $img->getClientOriginalExtension();
                $imageName = time() . '.' . $ext;
                $img->move(public_path('images/category_img'), $imageName);
                $productCat->image = 'images/category_img/' . $imageName;
            }

            $productCat->save();

            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully',
                'product' => $productCat
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Server error: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCat = ProductCat::findOrFail($id);

        if ($productCat->image && file_exists(public_path($productCat->image))) {
            unlink(public_path($productCat->image));
        }

        $productCat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product category deleted successfully'
        ]);
    }
}
