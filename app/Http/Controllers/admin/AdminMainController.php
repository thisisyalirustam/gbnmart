<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    //
    public function product_add()
    {
        $category = ProductCat::all();
        $subcategory = ProductSubCategory::all();
        $brand = ProductBrand::all();
        return view('admin.pages.products.product_create', compact('category', 'subcategory', 'brand'));
    }

    public function getSubcategoriesAndBrands($categoryId)
    {
        // Fetch subcategories related to the selected category
        $subcategories = ProductSubCategory::where('product_cat_id', $categoryId)->get();

        // Fetch brands related to the selected category
        $brands = ProductBrand::where('product_cat_id', $categoryId)->get();

        // Return both subcategories and brands as a JSON response
        return response()->json([
            'subcategories' => $subcategories,
            'brands' => $brands
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->status = $request->input('status');
        $product->save();

        return response()->json(['message' => 'Product status updated successfully']);
    }

    // Method to update product show on front (sof) only
    public function updateSOF(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->sof = $request->input('sof') === '1' ? 'Yes' : 'No';
            $product->save();

            return response()->json(['message' => 'Product visibility updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
