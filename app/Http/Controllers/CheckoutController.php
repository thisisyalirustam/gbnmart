<?php

namespace App\Http\Controllers;

use App\Mail\OrderConformation;
use App\Models\Cart;
use App\Models\Country;
use App\Models\CustomerAdress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        $cartItems = [];
        $subtotal = 0;

        if (Auth::check()) {
            $userId = Auth::id();
            $cartItems = Cart::where('carts.user_id', $userId)
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->get(['products.id as product_id', 'products.name', 'products.price', 'carts.quantity', 'products.images']);
        } else {
            // Fetch cart items from session for guest users
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    $cartItems[] = (object)[
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                        'images' => $product->images,
                    ];
                }
            }
        }
        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->quantity;
            $images = json_decode($item->images, true);
            $item->first_image = $images[0] ?? null;
        }
        $countries = Country::orderBy('name', 'asc')->get();
        return view('website.checkout', compact('cartItems', 'subtotal', 'countries'));
    }


    // public function processOrder(Request $request)
    // {
    //     // Validate incoming request
    //     $validate = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255|min:3',
    //         'email' => 'required|string|email|max:255',
    //         'phone' => 'required|string|max:20',
    //         'country_id' => 'required|integer',
    //         'address' => 'required|string|max:500',
    //         'apartment' => 'nullable|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'state' => 'required|string|max:255',
    //         'zip_code' => 'nullable|string|max:20',
    //         'order_notes' => 'nullable|string',
    //     ]);
    //     if ($validate->fails()) {
    //         return response()->json([
    //             'message' => 'Please fix the errors',
    //             'status' => false,
    //             'error' => $validate->errors()
    //         ]);
    //     }
    //     $userId = Auth::check() ? Auth::id() : null;
    //     if ($userId) {
    //         CustomerAdress::updateOrCreate(
    //             ['user_id' => $userId],
    //             [
    //                 'name' => $request->name,
    //                 'email' => $request->email,
    //                 'phone' => $request->phone,
    //                 'address' => $request->address,
    //                 'apartment' => $request->apartment,
    //                 'city' => $request->city,
    //                 'state' => $request->state,
    //                 'zip' => $request->zip_code,
    //                 'country_id' => $request->country_id,
    //             ]
    //         );
    //     }

    //     $orderData = [
    //         'user_id' => $userId, // Can be null for guests
    //         'subtotal' => 0, // Will recalculate later
    //         'shipping' => 10.00, // Example shipping cost
    //         'discount' => 0.00, // Example discount
    //         'grand_total' => 0, // Will recalculate later
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'country_id' => $request->country_id,
    //         'address' => $request->address,
    //         'apartment' => $request->apartment,
    //         'city' => $request->city,
    //         'state' => $request->state,
    //         'zip' => $request->zip_code,
    //         'note' => $request->order_notes,
    //         'payment_method' => $request->payment_method,
    //     ];
    //     $order = Order::create($orderData);
    //     $cartItems = Auth::check()
    //         ? Cart::where('user_id', $userId)->get()
    //         : collect(session('cart', []));
    //     $subtotal = 0;
    //     foreach ($cartItems as $item) {
    //         $product = Product::find($item['product_id']);
    //         if ($product) {
    //             $price = $product->price;
    //             $total = $price * $item['quantity'];
    //             $subtotal += $total;
    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $product->id,
    //                 'quantity' => $item['quantity'],
    //                 'price' => $price,
    //                 'name' => $product->name,
    //                 'total' => $total,
    //             ]);
    //         } else {
    //             return response()->json([
    //                 'message' => 'One or more items in your cart could not be found.',
    //                 'status' => false,
    //             ]);
    //         }
    //     }
    //     $grandTotal = $subtotal + $orderData['shipping'];
    //     $order->update([
    //         'subtotal' => $subtotal,
    //         'grand_total' => $grandTotal,
    //     ]);
    //     if (Auth::check()) {
    //         Cart::where('user_id', $userId)->delete();
    //     } else {
    //         session()->forget('cart');
    //     }
    //     return response()->json([
    //         'message' => 'Order placed successfully',
    //         'status' => true,
    //     ]);
    // }

    public function processOrder(Request $request)
{
    // Validate incoming request
    $validate = Validator::make($request->all(), [
        'name' => 'required|string|max:255|min:3',
        'email' => 'required|string|email|max:255',
        'phone' => 'required|string|max:20',
        'country_id' => 'required|integer',
        'address' => 'required|string|max:500',
        'apartment' => 'nullable|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'zip_code' => 'nullable|string|max:20',
        'order_notes' => 'nullable|string',
        'bank_invoice' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate bank_invoice
    ]);

    if ($validate->fails()) {
        return response()->json([
            'message' => 'Please fix the errors',
            'status' => false,
            'error' => $validate->errors()
        ]);
    }

    $userId = Auth::check() ? Auth::id() : null;

    if ($userId) {
        CustomerAdress::updateOrCreate(
            ['user_id' => $userId],
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip_code,
                'country_id' => $request->country_id,
            ]
        );
    }

    $bankInvoicePath = null;

    if ($request->hasFile('bank_invoice')) {
        $file = $request->file('bank_invoice');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('images/customer_image');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true); // Create the directory if it doesn't exist
        }

        $file->move($destinationPath, $fileName);
        $bankInvoicePath = 'images/customer_image/' . $fileName;
    }

    // Save $bankInvoicePath to your database


    $orderData = [
        'user_id' => $userId, // Can be null for guests
        'subtotal' => 0, // Will recalculate later
        'shipping' => 10.00, // Example shipping cost
        'discount' => 0.00, // Example discount
        'grand_total' => 0, // Will recalculate later
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'country_id' => $request->country_id,
        'address' => $request->address,
        'apartment' => $request->apartment,
        'city' => $request->city,
        'state' => $request->state,
        'zip' => $request->zip_code,
        'note' => $request->order_notes,
        'payment_method' => $request->payment_method,
        'bank_invoice' => $bankInvoicePath, // Save the image path
    ];

    $order = Order::create($orderData);

    $cartItems = Auth::check()
        ? Cart::where('user_id', $userId)->get()
        : collect(session('cart', []));

    $subtotal = 0;

    foreach ($cartItems as $item) {
        $product = Product::find($item['product_id']);
        if ($product) {
            $price = $product->price;
            $total = $price * $item['quantity'];
            $subtotal += $total;
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $price,
                'name' => $product->name,
                'total' => $total,
            ]);
        } else {
            return response()->json([
                'message' => 'One or more items in your cart could not be found.',
                'status' => false,
            ]);
        }
    }

    $grandTotal = $subtotal + $orderData['shipping'];
    $order->update([
        'subtotal' => $subtotal,
        'grand_total' => $grandTotal,
    ]);

    if (Auth::check()) {
        Cart::where('user_id', $userId)->delete();
    } else {
        session()->forget('cart');
    }

    $useremail=$request->input('email');
    $username=$request->input('name');
    $useradress=$request->input('address');
    $userphone=$request->input('phone');
    $method= $request->payment_method;

    Mail::to($useremail)->queue(new OrderConformation($username, $useremail, $useradress, $grandTotal, $userphone, $subtotal, $cartItems,));
    $orderDetails = [
        'orderId' => $order->id,
        'name' => $order->name,
        'email' => $order->email,
        'phone' => $order->phone,
        'address' => $order->address,
        'city' => $order->city,
        'state' => $order->state,
        'grand_total' => $grandTotal,
    ];

    // return response()->json([
    //     'message' => 'Order placed successfully',
    //     'status' => true,
    //     'orderId' => $order->id,
    //     'orderDetails' => $orderDetails,
    // ]);
    return redirect()->route('checkout.thankyou', ['orderId' => $order->id])
    ->with('orderDetails', $orderDetails);
}

public function thankYouPage($orderId)
{
    // Fetch order details from the database using the order ID
    $order = Order::findOrFail($orderId);

    // Pass the order details to the view
    return view('website.thankyou', compact('order'));
}
}
