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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AdminMainController extends Controller
{
    //
    public function product_add()
    {
        $category = ProductCat::all();
        $subcategory = ProductSubCategory::all();
        $brand = ProductBrand::all();
        $units = Unit::all();
        return view('admin.pages.products.product_create', compact('category', 'subcategory', 'brand', 'units'));
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

    public function quickShow(string $id)
    {


        $ordershow = Order::with(['user', 'country', 'items.product'])->find($id);

        if (!$ordershow) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        // Decode product images and set the first image
        foreach ($ordershow->items as $item) {
            $images = json_decode($item->product->images, true);
            $item->product->images = $images[0] ?? 'default-image.jpg';
        }
        $coupon = $ordershow->coupon_code;
        $vendor = Affiliate::with(['user'])->where('coupon', $coupon)->first();

        return response()->json([
            'success' => true,
            'data' => $ordershow
        ]);
    }

    public function getProfile()
    {

        return view('admin.pages.dashboard.profile');
    }

    public function update(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        $user = User::find($request->input('userid'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->save();
        return redirect()->back()->with('success', 'Profile Update Successfully!');

    }

    public function changePassword(Request $request)
    {
        // Log the incoming request data
        Log::info('Change Password Request:', $request->all());
    
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            // Log validation errors
            Log::error('Validation Errors:', $validator->errors()->toArray());
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
    
        $user = User::find($request->input('userid'));
    
        if (!$user) {
            // Log user not found error
            Log::error('User not found:', ['userid' => $request->input('userid')]);
            return response()->json(['error' => 'User not found.'], 404);
        }
    
        if (!Hash::check($request->current_password, $user->password)) {
            // Log current password mismatch
            Log::error('Current password mismatch:', ['userid' => $user->id]);
            return response()->json(['error' => 'The current password is incorrect.'], 422);
        }
    
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        // Log successful password change
        Log::info('Password changed successfully:', ['userid' => $user->id]);
        return redirect()->back()->with('success', 'Password Update Successfully!');
    }

    
}
