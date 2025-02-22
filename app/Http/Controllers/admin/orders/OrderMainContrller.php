<?php

namespace App\Http\Controllers\admin\orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderMainContrller extends Controller
{
    //
    public function ordersAll(){

        return view('admin.pages.orders.orders_all');
        
    }
    public function OrderReturnJson(){
        $order=Order::orderBy('id','desc')->where('shipping_status','return')->get();
        return response()->json([
            'status'=>'success',
            'data'=>$order
        ]);
    }
    public function OrderCompeleteJson(){
        $order=Order::orderBy('id','desc')->where('shipping_status','Complete')->get();
        return response()->json([
            'status'=>'success',
            'data'=>$order
        ]);
    }
    public function OrderActiveJson(){
        $order=Order::orderBy('id','desc')->where('shipping_status','Pending')->get();
        return response()->json([
            'status'=>'success',
            'data'=>$order
        ]);
    }
    public function ordersReturn(){
        return view('admin.pages.orders.orders_return');
    }
    public function ordersCompelete(){
        return view ('admin.pages.orders.orders_compelete');
    }
    public function ordersAdmin(){

    }
    public function ordersActive(){
        return view('admin.pages.orders.orders_active');
    }
   
}
