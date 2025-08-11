<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\Cart;
use App\Models\Order;
use App\Models\RattingAndReview;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BuyerDashboadController extends Controller
{
    //
    public function dash()
{
    $userId = Auth::check() ? Auth::id() : null;

    // User's orders and related info
    $order = Order::where("user_id", $userId)->get();
    $ordercount = $order->count();
    $cartcount = Cart::where("user_id", $userId)->count();
    $returnCount = Order::where("user_id", $userId)->where("shipping_status", "Return")->count();
    $processCount = Order::where("user_id", $userId)->where("shipping_status", "Process")->count();
    $orderprocess = Order::where("user_id", $userId)->where("shipping_status", "Process")->get();
    $orderpending = Order::where("user_id", $userId)->where("shipping_status", "Pending")->get();
    $ordercompelte = Order::where("user_id", $userId)->where("shipping_status", "Complete")->get();
    
    // Wishlist
    $wishlist = Wishlist::with('product')->where('user_id', $userId)->get();

    // Orders with related info for display
    $ordershow = Order::with(['user', 'country', 'items.product'])
        ->where('user_id', $userId)
        ->get();

    // // Safeguard for empty orders
    // if ($ordershow->isEmpty()) {
    //     return redirect()->route('dashboard')->with('error', 'Order not found.');
    // }

    // Format product images
  

    // ✅ Fetch reviews written BY this user
   $ratingandreview = RattingAndReview::with(['orderItem.product', 'orderItem.order'])
    ->whereHas('orderItem.order', function ($query) use ($userId) {
        $query->where('user_id', $userId);
    })
    ->orderBy('created_at', 'desc')
    ->where('status', 1)
    ->get();

  foreach ($ordershow as $orderItem) {
        foreach ($orderItem->items as $item) {
            $images = json_decode($item->product->images, true);
            $item->product->images = $images[0] ?? 'default-image.jpg';
        }
    }
    return view('dashboard', compact(
        'order', 'ordercount', 'orderprocess', 'orderpending', 'ordercompelte',
        'cartcount', 'returnCount', 'processCount', 'ordershow', 'wishlist', 'ratingandreview'
    ));
}


    public function orderproduct($id)
    {
        $userId = Auth::check() ? Auth::id() : null;  // Check if the user is authenticated
        $ordershow = Order::with(['user', 'country', 'items.product'])->find($id);
        if (!$ordershow) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }
        foreach ($ordershow->items as $item) {
            $images = json_decode($item->product->images, true);
            $item->product->images = $images[0] ?? 'default-image.jpg';
        }
        return view('orderProduct', compact('ordershow'));
    }


    public function account()
    {
        return view('account');
    }
    public function affliate()
    {
        $user = Auth::user(); // Get the authenticated user
        $affiliate = Affiliate::where('user_id', $user->id)->first();
        $bankDetails = $affiliate ? $affiliate->bank_details : null;
        return view('affliate', compact('affiliate', 'bankDetails'));
    }

    public function applayAffliate()
    {
        $userId = Auth::check() ? Auth::id() : null;
        $user = User::where('id', $userId)->first();

        return view('applayForAffliate', compact('user'));
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
        $request->validate([
            'account_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'ifsc_code' => 'required|string',
        ]);
        $user = Auth::user();
        $affiliate = Affiliate::where('user_id', $user->id)->first();
        if ($affiliate) {
            $affiliate->update([
                'bank_details' => [
                    'account_name' => $request->account_name,
                    'bank_name' => $request->bank_name,
                    'account_number' => $request->account_number,
                    'ifsc_code' => $request->ifsc_code,
                ]
            ]);
            return redirect()->route('website.affliate.applay')->with('success', 'Bank details updated successfully!');
        } else {
            return redirect()->route('website.affliate.applay')->with('error', 'Affiliate record not found!');
        }
    }
}
