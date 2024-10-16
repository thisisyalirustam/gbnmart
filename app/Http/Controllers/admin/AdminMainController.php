<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
}
