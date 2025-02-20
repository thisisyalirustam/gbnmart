<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Affiliate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();

    // Calculate today's sales where shipping status is 'Complete'
    $todayorders = Order::whereDate('created_at', Carbon::today())
    ->count();

    // Calculate total sales
    $totalSalesCount = $orders->count();

    // Calculate total income
    $totalIncomeAmount = $orders->where('shipping_status','Complete')->sum('grand_total'); // Assuming 'grand_total' is the column name

    // Calculate pending orders
    $pendingOrdersCount = Order::where('shipping_status', 'Pending')->count();

    // Calculate monthly sales where shipping status is 'Complete'
    $monthlySalesCount = Order::where('shipping_status', 'Complete')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->count();

    // Calculate monthly total income for completed orders
    $monthlyIncomeAmount = Order::where('shipping_status', 'Complete')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('grand_total');

    // Calculate daily income where shipping status is 'Complete'
    $todaysSalesCount  = Order::whereDate('delivered_date', today())
        ->where('shipping_status', 'Complete')->count();

    // Pass the calculated values to the view
    return view('admin.pages.orders.orders', compact(
        'todaysSalesCount',
        'totalSalesCount',
        'totalIncomeAmount',
        'pendingOrdersCount',
        'monthlySalesCount',
        'monthlyIncomeAmount',
        'todayorders'
    ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
            $coupon=$ordershow->coupon_code;
            $vendor=Affiliate::with(['user'])->where('coupon',$coupon)->first();
           
            return view('admin.pages.orders.ordersDetails', compact('ordershow','vendor'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

       
       
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $orderShow = Order::find($id);

        // Check if the order exists
        if (!$orderShow) {
            return redirect()->back()->with('error', 'Order not found.');
        }
        $request->validate([
            'subtotal' => 'required|numeric|min:0',
            'shipping' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'grand_total' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'apartment' => 'nullable|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'zip' => 'nullable|string|max:20',
            'note' => 'nullable|string|max:500',
        ]);
    
        // Update the order with the new data
        $orderShow->update([
            'subtotal' => $request->subtotal,
            'shipping' => $request->shipping,
            'discount' => $request->discount,
            'grand_total' => $request->grand_total,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'apartment' => $request->apartment,
            'country_id' => $request->country_id,
            'state_id' => $request->state,
            'city_id' => $request->city,
            'zip' => $request->zip,
            'note' => $request->note,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('coustomer-orders.index')->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $order=Order::findOrFail($id);
        $order->delete();
        return response()->json([
            'success'=> true,
            'message'=>'Order Delete SuccessFully',
        ]);
    }

    public function quickShow(string $id){
     

        $ordershow = Order::with(['user', 'country', 'items.product'])->find($id);

        if (!$ordershow) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        // Decode product images and set the first image
        foreach ($ordershow->items as $item) {
            $images = json_decode($item->product->images, true);
            $item->product->images = $images[0] ?? 'default-image.jpg';
        }
        $coupon=$ordershow->coupon_code;
        $vendor=Affiliate::with(['user'])->where('coupon',$coupon)->first();

       return response()->json([
        'success'=>true,
        'data'=>$ordershow
       ]);
    }
}
