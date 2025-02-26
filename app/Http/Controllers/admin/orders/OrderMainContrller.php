<?php

namespace App\Http\Controllers\admin\orders;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\RattingAndReview;
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

    public function show($token)
    {
        // Find the order by token and ensure review is not already completed
        $order = Order::where('review_token', $token)
                      ->where('review_completed', false)
                      ->with('orderItems.product') // Eager load orderItems and their associated products
                      ->firstOrFail();
        $orderItems = $order->orderItems;
        return view('website.rating_and_review', compact('order', 'orderItems'));
    }

    // Store review
    public function store(Request $request, $token)
    {
        // Find the order by token and ensure review is not already completed
        $order = Order::where('review_token', $token)
                      ->where('review_completed', false)
                      ->firstOrFail();
    
        // Save reviews for each product
        foreach ($order->orderItems as $item) {
            RattingAndReview::create([
                'order_item_id' => $item->id,
                'reviewer_name' => $order->user_id ? $order->user->name : $order->name,
                'reviewer_email' => $order->user_id ? $order->user->email : $order->email,
                'rating' => $request->input('rating.' . $item->id),
                'review' => $request->input('review.' . $item->id),
                'status' => 0, // Default status
            ]);
        }
    
        // Mark review as completed and invalidate the token
        $order->review_completed = true;
        $order->review_token = null; // Invalidate the token
        $order->save();
    
        return redirect()->route('homepage')->with('success', 'Thank you for your review!');
    }

    public function getRatingAndReview(){
        $rating = RattingAndReview::with(['orderItem.product', 'orderItem.order'])
        ->orderBy('created_at', 'desc')
        ->get();
    
    // Return the response with the data
    return response()->json([
        'status' => true,
        'data' => $rating
    ]);
    }
   
    public function showRatingAndReview(){

        return view('admin.pages.orders.rating_review');
    }

    public function updateStatus($id, Request $request)
{
    // Find the order by ID
    $order = RattingAndReview::find($id);

    if (!$order) {
        return response()->json([
            'status' => false,
            'message' => 'Order not found'
        ]);
    }

    // Toggle the status
    $order->status = $request->status;  // 0 for Pending, 1 for Active
    $order->save();

    // Prepare the response based on the new status
    $newStatusText = $order->status == 0 ? "Pending" : "Active";
    $newButtonClass = $order->status == 0 ? "btn-warning" : "btn-success";

    return response()->json([
        'status' => true,
        'newStatusText' => $newStatusText,
        'newButtonClass' => $newButtonClass
    ]);
}

public function deleteOrder($id){
    $rating = RattingAndReview::find($id);
    $rating->delete();
    return response()->json(['success'=>true,'message'=>'product Delete successfully']);
}

}
