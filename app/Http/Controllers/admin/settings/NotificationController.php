<?php

namespace App\Http\Controllers\admin\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function storeOrder(Request $request)
    {
        // Create the order
        // $order = Order::create([...]);
    
        // Store the notification
        // Notification::create([
        //     'message' => "New order placed by {$order->name} for \${$order->grand_total}.",
        // ]);
    
        // // Trigger the event
        // event(new OrderPlaced($order));
    
        // return response()->json(['message' => 'Order placed successfully!']);
    }
}
