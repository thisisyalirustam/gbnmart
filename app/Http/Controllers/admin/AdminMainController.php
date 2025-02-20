<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    //
    public function product_add()
    {
        $category = ProductCat::all();
        $subcategory = ProductSubCategory::all();
        $brand = ProductBrand::all();
        $units=Unit::all();
        return view('admin.pages.products.product_create', compact('category', 'subcategory', 'brand','units'));
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

    public function quickShow(string $id){
     

        $ordershow = Order::with(['user', 'country', 'items.product'])->find($id);

        if (!$ordershow) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        // Decode product images and set the first image
        foreach ($ordershow->items as $item) {
            $images = json_decode($item->product->images, true);
            $item->product->images = $images[0] ?? 'default-image.jpg';
        }
        $coupon=$ordershow->coupon_code;
        $vendor=Affiliate::with(['user'])->where('coupon',$coupon)->first();

       return response()->json([
        'success'=>true,
        'data'=>$ordershow
       ]);
    }

}
