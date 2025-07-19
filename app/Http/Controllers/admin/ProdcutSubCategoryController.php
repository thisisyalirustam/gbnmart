<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdcutSubCategoryController extends Controller
{
    public function index()
    {
        $product_cat = ProductCat::where('status', 1)->get();
        $product_sub_cat = ProductSubCategory::with('product_cat')->get();
        return view('admin.pages.products.product_sub_cat', compact('product_sub_cat', 'product_cat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_cat_id' => 'required',
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_sub_categories', 'public');
        }

        $p_sub_category = ProductSubCategory::create([
            'product_cat_id' => $request->product_cat_id,
            'name' => $request->name,
            'image' => $imagePath
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'product' => $p_sub_category
        ]);
    }

    public function show(string $id)
    {
        $product = ProductSubCategory::with('product_cat')->where(['id' => $id])->get();
        return response()->json([
            'status' => true,
            'message' => 'Your beautiful user',
            'product' => $product
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_cat_id' => 'required',
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = ProductSubCategory::findOrFail($id);
        
        $data = [
            'product_cat_id' => $request->product_cat_id,
            'name' => $request->name
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('product_sub_categories', 'public');
        }

        $product->update($data);

        return response()->json([
            'success' => true,
            'message' => 'updated successfully',
            'product' => $product
        ]);
    }

    public function destroy(string $id)
    {
        $product = ProductSubCategory::findOrFail($id);
        
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'product deleted successfully',
            'product' => $product
        ]);
    }
}