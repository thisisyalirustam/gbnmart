<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BuyerDashboadController extends Controller
{
    //
    public function dash(){
        $userId = Auth::check() ? Auth::id() : null;
        $order=Order::where("user_id", $userId)->get();
        $ordercount=Order::where("user_id",$userId)->count();
        $cartcount=Cart::where("user_id",$userId)->count();
        $returnCount=Order::where("user_id",$userId)->where("shipping_status","Return")->count();
        $processCount=Order::where("user_id",$userId)->where("shipping_status","Process")->count();
        $orderprocess=Order::where("user_id",$userId)->where("shipping_status","Process")->get();
        $orderpending=Order::where("user_id",$userId)->where("shipping_status","Pending")->get();
        $ordercompelte=Order::where("user_id",$userId)->where("shipping_status","Complete")->get();
        return view('dashboard',compact('order','ordercount','orderprocess','orderpending','ordercompelte','cartcount','returnCount','processCount'));

    }

    public function orderproduct($id) {
        $userId = Auth::check() ? Auth::id() : null;  // Check if the user is authenticated

        // Fetch the order with its related data (user, country, and items with products)
        $ordershow = Order::with(['user', 'country', 'items.product'])->find($id);

        // If the order is not found, redirect back with an error message
        if (!$ordershow) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        // Decode product images and set the first image
        foreach ($ordershow->items as $item) {
            $images = json_decode($item->product->images, true);
            $item->product->images = $images[0] ?? 'default-image.jpg';
        }

        // Return the order details view with the fetched data
        return view('orderProduct', compact('ordershow'));
    }


    public function account(){
        return view('account');
    }

    // public function affliate(){
    //     return view('affliate');
    // }
    public function affliate()
    {
        $user = Auth::user(); // Get the authenticated user

        $affiliate = Affiliate::where('user_id', $user->id)->first();

        // If the user doesn't have an affiliate account, pass null for bank details
        $bankDetails = $affiliate ? $affiliate->bank_details : null;

        return view('affliate', compact('affiliate', 'bankDetails'));
    }

    public function applayAffliate(){
        $userId = Auth::check() ? Auth::id() : null;
        $user=User::where('id',$userId)->first();

        return view('applayForAffliate',compact('user'));
    }



    public function affliateStore(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'cnic' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Update the user profile if a new image is uploaded
        if ($request->hasFile('profile_image')) {
            if ($user->image) {
                Storage::delete('uploads/' . $user->image);
            }
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $user->image = $imageName;
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'cnic' => $request->cnic,
        ]);
        Affiliate::firstOrCreate([
            'user_id' => $user->id,
        ]);

        return response()->json([
            'success' => true,
        ]);
    }

    public function saveBankDetails(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'account_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'ifsc_code' => 'required|string',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Get the user's affiliate record (if it exists)
        $affiliate = Affiliate::where('user_id', $user->id)->first();

        // Check if the affiliate record exists
        if ($affiliate) {
            // Update the bank details in the existing affiliate record
            $affiliate->update([
                'bank_details' => [
                    'account_name' => $request->account_name,
                    'bank_name' => $request->bank_name,
                    'account_number' => $request->account_number,
                    'ifsc_code' => $request->ifsc_code,
                ]
            ]);

            // Return a success message
            return redirect()->route('website.affliate.applay')->with('success', 'Bank details updated successfully!');
        } else {
            // If affiliate does not exist, return an error (optional)
            return redirect()->route('website.affliate.applay')->with('error', 'Affiliate record not found!');
        }
    }




}


