<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class ProductMainController extends Controller
{
    //
    public function getOrderDetails(Request $request)
    {
        $ordersCount = Order::whereDate('created_at', Carbon::today())->where('status','Complete')->count();
        // Return the response as JSON
        return response()->json([
            'success' => true,
            'todayorders' => $ordersCount,
        ]);
    }
}
