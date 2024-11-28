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

    public function orderproduct(){
        $userId = Auth::check() ? Auth::id() : null;
        $order=Order::with(['items.product'])->where("user_id", $userId)->get();
        $ordercount=Order::where("user_id",$userId)->count();
        $orderprocess=Order::where("user_id",$userId)->where("shipping_status","Process")->get();
        $orderpending=Order::where("user_id",$userId)->where("shipping_status","Pending")->get();
        $ordercompelte=Order::where("user_id",$userId)->where("shipping_status","Complete")->get();
        return view('orderProduct',compact('order','ordercount','orderprocess','orderpending','ordercompelte'));

    }

    public function account(){
        return view('account');
    }
}
