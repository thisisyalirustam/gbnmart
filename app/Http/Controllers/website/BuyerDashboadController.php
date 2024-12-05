<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
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
}
