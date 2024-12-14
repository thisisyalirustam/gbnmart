<?php

namespace App\Http\Controllers;

use App\Mail\OrderConformation;
use App\Models\Cart;
use App\Models\City;
use App\Models\Country;
use App\Models\CustomerAdress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingCharge;
use App\Models\State;
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
                ->get(['products.id as product_id', 'products.name', 'products.price', 'carts.quantity',  'products.weight', 'products.unit_id', 'products.images']);
        } else {
            // Fetch cart items from session for guest users
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $productId => $item) {
                $product = Product::with('unit')->find($productId);
                if ($product) {
                    $cartItems[] = (object)[
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'unit'=> $product->unit->symbol,
                        'unit_id'=> $product->unit->id,
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
        $state = State::orderBy('name', 'asc')->get();
        $city = City::orderBy('name', 'asc')->get();
        return view('website.checkout', compact('cartItems', 'subtotal', 'countries', 'state', 'city'));
    }



    public function processOrder(Request $request)
    {



        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'country_id' => 'required|integer',
            'address' => 'required|string|max:500',
            'apartment' => 'nullable|string|max:255',
            'city_id' => 'required|integer',
            'state_id' => 'required|integer',
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
                    'city_id' => $request->city_id,
                    'state_id' => $request->state_id,
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
            // 'shipping' => 10.00, // Example shipping cost
            'discount' => 0.00, // Example discount
            'grand_total' => 0, // Will recalculate later
            'shipping' => $request->shipping_charge,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'address' => $request->address,
            'apartment' => $request->apartment,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
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

        $useremail = $request->input('email');
        $username = $request->input('name');
        $useradress = $request->input('address');
        $userphone = $request->input('phone');
        $method = $request->payment_method;

        Mail::to($useremail)->queue(new OrderConformation($username, $useremail, $useradress, $grandTotal, $userphone, $subtotal, $cartItems,));
        $orderDetails = [
            'orderId' => $order->id,
            'name' => $order->name,
            'email' => $order->email,
            'phone' => $order->phone,
            'address' => $order->address,
            'grand_total' => $grandTotal,
        ];

        return response()->json([
            'message' => 'Order placed successfully',
            'status' => true,
            'orderId' => $order->id,
            'orderDetails' => $orderDetails,
        ]);
        // return redirect()->route('checkout.thankyou', ['orderId' => $order->id])
        // ->with('orderDetails', $orderDetails);
    }

    public function thankYouPage($orderId)
    {
        // Fetch order details from the database using the order ID
        $order = Order::findOrFail($orderId);

        // Pass the order details to the view
        return view('website.thankyou', compact('order'));
    }

    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    // Get cities based on state_id
    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }

    // In CheckoutController.php or the relevant controller

    // public function getShippingCharge(Request $request)
    // {
    //     if($request->city_id>0){

    //         $cartItems = [];
    //         $subtotal = 0;

    //         if (Auth::check()) {
    //             $userId = Auth::id();
    //             $cartItems = Cart::where('carts.user_id', $userId)
    //                 ->join('products', 'carts.product_id', '=', 'products.id')
    //                 ->get(['products.id as product_id', 'products.name', 'products.price', 'carts.quantity',  'carts.weight', 'products.unit_id', 'products.images']);
    //         } else {
    //             // Fetch cart items from session for guest users
    //             $sessionCart = session('cart', []);
    //             foreach ($sessionCart as $productId => $item) {
    //                 $product = Product::with('unit')->find($productId);
    //                 if ($product) {
    //                     $cartItems[] = (object)[
    //                         'product_id' => $product->id,
    //                         'name' => $product->name,
    //                         'unit_id'=>$product->id,
    //                         'price' => $product->price,
    //                         'quantity' => $item['quantity'],

    //                     ];
    //                 }
    //             }
    //         }
    //         foreach ($cartItems as $item) {
    //             $subtotal += $item->price * $item->quantity;
    //             $qty= $item->quantity;
    //         }
    //         $unitcharge =ShippingCharge::where('unit_id', $request->unit_id)->first();
    //         $shippingInfo =  ShippingCharge::where('city_id',$request->city_id)->first();
    //         if($shippingInfo != null){
    //             $shippingCharge = $qty*$shippingInfo->charge;
    //             $grand_total= $subtotal+ $shippingCharge;

    //             return response()->json([
    //                 'status'=>true,
    //                 'grand_total'=> $grand_total,
    //                 'shippingCharge' => $shippingCharge
    //             ]);
    //         } else{
    //             $shippingCharge=10;
    //         return response()->json([
    //             'status'=>true,
    //             'shippingCharge' => $shippingCharge
    //         ]);
    //         }
    //     }else{
    //         $shippingCharge=0;
    //         return response()->json([
    //             'status'=>true,
    //             'shippingCharge' => $shippingCharge
    //         ]);
    //     }
    // }


    public function getShippingCharge(Request $request)
{
    if ($request->city_id > 0) {
        $cartItems = [];
        $subtotal = 0;
        $totalShippingCharge = 0;

        // Fetch cart items
        if (Auth::check()) {
            $userId = Auth::id();
            $cartItems = Cart::where('carts.user_id', $userId)
                ->join('products', 'carts.product_id', '=', 'products.id')
                ->get(['products.id as product_id', 'products.name', 'products.price', 'carts.quantity', 'products.weight', 'products.unit_id', 'products.images']);
        } else {
            // Fetch cart items for guest users
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $productId => $item) {
                $product = Product::with('unit')->find($productId);
                if ($product) {
                    $cartItems[] = (object)[
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'weight'=>$product->weight,
                        'unit_id' => $product->unit_id,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                    ];
                }
            }
        }

        // Loop through cart items and calculate the subtotal and shipping charges
        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->quantity;
            $qty = $item->quantity;
            $weight =$item->weight;

            // Get the shipping charge for the unit of this product
            $shippingChargeForUnit = ShippingCharge::where('unit_id', $item->unit_id)
                ->where('city_id', $request->city_id)
                ->first();

            if ($shippingChargeForUnit) {
                // Calculate the shipping charge for this product
                $weightCharge=$shippingChargeForUnit->charge*$weight;
                $totalShippingCharge += $weightCharge * $qty;
            } else {
                // If no specific charge is found, set a default shipping charge
                $totalShippingCharge += 10; // Default charge if no specific charge is found
            }
        }

        // Calculate the grand total (subtotal + total shipping charge)
        $grand_total = $subtotal + $totalShippingCharge;

        return response()->json([
            'status' => true,
            'grand_total' => $grand_total,
            'shippingCharge' => $totalShippingCharge
        ]);
    } else {
        return response()->json([
            'status' => false,
            'shippingCharge' => 0
        ]);
    }
}

}
