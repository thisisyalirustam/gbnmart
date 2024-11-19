<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Country;
use App\Models\CustomerAdress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        $cartItems = [];
        $subtotal = 0;

        if (Auth::check()) {
            // Fetch cart items for logged-in user
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

        // Calculate subtotal
        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->quantity;
            $images = json_decode($item->images, true);
            $item->first_image = $images[0] ?? null;
        }
        $countries=Country::orderBy('name','asc')->get();
        return view('website.checkout', compact('cartItems', 'subtotal','countries'));
    }

    // public function processOrder(Request $request)
    // {
    //     // Validate incoming request
    //     $validate = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255|min:3',
    //         'email' => 'required|string|email|max:255',
    //         'phone' => 'required|string|max:20',
    //         'country_id' => 'required|integer', // Assuming country_id is an integer
    //         'address' => 'required|string|max:500',
    //         'apartment' => 'nullable|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'state' => 'required|string|max:255',
    //         'zip_code' => 'nullable|string|max:20',
    //         'order_notes' => 'nullable|string',
    //     ]);

    //     // Check if validation fails
    //     if ($validate->fails()) {
    //         return response()->json([
    //             'message' => 'Please fix the errors',
    //             'status' => false,
    //             'error' => $validate->errors()
    //         ]);
    //     }

    //     // Determine user ID
    //     $userId = Auth::check() ? Auth::id() : null;

    //     // If user is authenticated, save the address in the CustomerAddress table
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

    //     // Prepare order data
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
    //     ];

    //     // Create the order
    //     $order = Order::create($orderData);

    //     // Retrieve cart items to calculate subtotal and create order items
    //     $cartItems = Auth::check()
    //         ? Cart::where('user_id', $userId)->get()
    //         : collect(session('cart', []));

    //     // Calculate subtotal and create order items
    //     $subtotal = 0;

    //     foreach ($cartItems as $item) {
    //         // For guest users or if the item is an associative array
    //         $product = Product::find($item['product_id']); // Assuming $item is an associative array for guests

    //         // Check if the product exists
    //         if ($product) {
    //             $price = $product->price; // Get the price from the product

    //             // Calculate subtotal for the order item
    //             $total = $price * $item['quantity'];
    //             $subtotal += $total; // Update subtotal for the order

    //             // Create order items with fetched price
    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $product->id,
    //                 'quantity' => $item['quantity'],
    //                 'price' => $price, // Use the fetched price
    //                 'name' => $product->name, // Use the product name
    //                 'total' => $total, // Include the total
    //             ]);
    //         } else {
    //             // Handle case where product is not found

    //             return response()->json([
    //                 'message' => 'One or more items in your cart could not be found.',
    //                 'status' => false,
    //             ]);
    //         }
    //     }



    //     // Calculate grand total
    //     $grandTotal = $subtotal + $orderData['shipping'];

    //     // Update the order with calculated values
    //     $order->update([
    //         'subtotal' => $subtotal,
    //         'grand_total' => $grandTotal,
    //     ]);

    //     // Clear the cart for authenticated users
    //     if (Auth::check()) {
    //         Cart::where('user_id', $userId)->delete();
    //     } else {
    //         // For guests, clear the session cart
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
        ]);

        // Check if validation fails
        if ($validate->fails()) {
            return response()->json([
                'message' => 'Please fix the errors',
                'status' => false,
                'error' => $validate->errors()
            ]);
        }

        // Determine user ID
        $userId = Auth::check() ? Auth::id() : null;

        // Save the address if the user is authenticated
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

        // Prepare order data
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
        ];

        // Create the order
        $order = Order::create($orderData);

        // Retrieve cart items to calculate subtotal and create order items
        $cartItems = Auth::check()
            ? Cart::where('user_id', $userId)->get()
            : collect(session('cart', []));

        // Calculate subtotal and create order items
        $subtotal = 0;

        foreach ($cartItems as $item) {
            $product = Product::find($item['product_id']); // Assuming $item is an associative array for guests

            // Check if the product exists
            if ($product) {
                $price = $product->price; // Get the price from the product

                // Calculate subtotal for the order item
                $total = $price * $item['quantity'];
                $subtotal += $total; // Update subtotal for the order

                // Create order items with fetched price
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $price, // Use the fetched price
                    'name' => $product->name, // Use the product name
                    'total' => $total, // Include the total
                ]);
            } else {
                // Handle case where product is not found
                return response()->json([
                    'message' => 'One or more items in your cart could not be found.',
                    'status' => false,
                ]);
            }
        }

        // Calculate grand total
        $grandTotal = $subtotal + $orderData['shipping'];

        // Update the order with calculated values
        $order->update([
            'subtotal' => $subtotal,
            'grand_total' => $grandTotal,
        ]);

        // Clear the cart for authenticated users
        if (Auth::check()) {
            Cart::where('user_id', $userId)->delete();
        } else {
            // For guests, clear the session cart
            session()->forget('cart');
        }

        return response()->json([
            'message' => 'Order placed successfully',
            'status' => true,
        ]);
    }


}
