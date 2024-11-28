<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\ShippingCharge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function index()
    {
        return view('admin.pages.dashboard.index');
    }
    public function showuser()
    {
        $users = User::all()->map(function ($user) {
            if ($user->image) {
                // Ensure the image URL is correct
                $user->image = url('uploads/' . $user->image);
            }
            return $user;
        });

        return response()->json($users);
    }
    public function showproductcat()
    {
        $product_cat = ProductCat::orderBy('id', 'DESC')->get()->map(function ($category) {
            if ($category->image) {
                $category->image = url('images/category_img/' . basename($category->image));
            }
            return $category;
        });

        return response()->json($product_cat);
    }


    public function product_sub_cat()
    {
        $product_sub_cat = ProductSubCategory::with('product_cat')->get();
        return response()->json($product_sub_cat);
    }

    public function product_brand()
    {
        $brand = ProductBrand::with('product_cat')->get();
        return response()->json($brand);
    }
    public function product()
    {

        $products = Product::with('product_cat', 'product_sub_category', 'product_brand', 'user')
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
    public function shipping(){
        $shipping = ShippingCharge::with('country', 'state', 'city')->get();
        return response()->json($shipping);
    }
    public function orders(){
        $order = Order::orderBy('id', 'desc')->get();
        return response()->json($order);


    }
    public function updateDeliveryDate(Request $request, $id)
    {


        // Find the order by ID and update the delivery date
        $order = Order::findOrFail($id);
        $order->delivered_date = $request->delivered_date;
        $order->save();

        return redirect()->back()->with('success', 'Delivery date updated successfully!');
    }




    public function updateShippingStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->shipping_status = $request->shipping_status;
    $order->save();

    return redirect()->back()->with('success', 'Delivery date updated successfully!');
}



}
