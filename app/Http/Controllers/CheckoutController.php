<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
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
use App\Models\Affiliate;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Str;
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
                ->get(['products.id as product_id', 'products.name', 'products.price', 'carts.quantity', 'products.weight', 'products.unit_id', 'products.images']);
        } else {
            // Fetch cart items from session for guest users
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $productId => $item) {
                $product = Product::with('unit')->find($productId);
                if ($product) {
                    $cartItems[] = (object) [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'unit' => $product->unit->symbol,
                        'unit_id' => $product->unit->id,
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
    // public function processOrder(Request $request)
    // {
    //     $validate = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255|min:3',
    //         'email' => 'required|string|email|max:255',
    //         'phone' => 'required|string|max:20',
    //         'country_id' => 'required|integer',
    //         'address' => 'required|string|max:500',
    //         'apartment' => 'nullable|string|max:255',
    //         'city_id' => 'required|integer',
    //         'state_id' => 'required|integer',
    //         'zip_code' => 'nullable|string|max:20',
    //         'order_notes' => 'nullable|string',
    //         'bank_invoice' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate bank_invoice
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
    //                 'city_id' => $request->city_id,
    //                 'state_id' => $request->state_id,
    //                 'zip' => $request->zip_code,
    //                 'country_id' => $request->country_id,
    //             ]
    //         );
    //     }

    //     $bankInvoicePath = null;

    //     if ($request->hasFile('bank_invoice')) {
    //         $file = $request->file('bank_invoice');
    //         $fileName = time() . '_' . $file->getClientOriginalName();
    //         $destinationPath = public_path('images/customer_image');

    //         if (!file_exists($destinationPath)) {
    //             mkdir($destinationPath, 0777, true); // Create the directory if it doesn't exist
    //         }

    //         $file->move($destinationPath, $fileName);
    //         $bankInvoicePath = 'images/customer_image/' . $fileName;
    //     }

    //     // Save $bankInvoicePath to your database
    //     $reviewToken = Str::random(60);
    //     $orderData = [
    //         'user_id' => $userId,
    //         'subtotal' => 0,
    //         'discount' => $request->discount,
    //         'coupon_code' => $request->coupon_code,
    //         'grand_total' => 0,
    //         'shipping' => $request->shipping_charge,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'country_id' => $request->country_id,
    //         'address' => $request->address,
    //         'apartment' => $request->apartment,
    //         'city_id' => $request->city_id,
    //         'state_id' => $request->state_id,
    //         'zip' => $request->zip_code,
    //         'note' => $request->order_notes,
    //         'payment_method' => $request->payment_method,
    //         'bank_invoice' => $bankInvoicePath, // Save the image path
    //         'review_token' => $reviewToken,

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
    //     $discount= 0;

    //     if($request->coupon_code){
    //         $discount=$request->discount;
    //     }

    //     $grandTotal = ($subtotal-$discount) + $orderData['shipping'];
    //     $order->update([
    //         'subtotal' => $subtotal,
    //         'grand_total' => $grandTotal,

    //     ]);

    //     if (Auth::check()) {
    //         Cart::where('user_id', $userId)->delete();
    //     } else {
    //         session()->forget('cart');
    //     }

    //     $useremail = $request->input('email');
    //     $username = $request->input('name');
    //     $useradress = $request->input('address');
    //     $userphone = $request->input('phone');
    //     $method = $request->payment_method;

    //     Mail::to($useremail)->queue(new OrderConformation($username, $useremail, $useradress, $grandTotal, $userphone, $subtotal, $cartItems,));
    //     $orderDetails = [
    //         'orderId' => $order->id,
    //         'name' => $order->name,
    //         'email' => $order->email,
    //         'phone' => $order->phone,
    //         'address' => $order->address,
    //         'grand_total' => $grandTotal,
    //     ];

    //     return response()->json([
    //         'message' => 'Order placed successfully',
    //         'status' => true,
    //         'orderId' => $order->id,
    //         'orderDetails' => $orderDetails,
    //     ]);
    //     // return redirect()->route('checkout.thankyou', ['orderId' => $order->id])
    //     // ->with('orderDetails', $orderDetails);
    // }


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

        // Generate a unique review token
        

        $orderData = [
            'user_id' => $userId,
            'subtotal' => 0,
            'discount' => $request->discount,
            'coupon_code' => $request->coupon_code,
            'grand_total' => 0,
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
        $reviewToken = Str::random(60);
        $order->review_token = $reviewToken;
        $order->save();
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
        $discount = 0;

        if ($request->coupon_code) {
            $discount = $request->discount;
        }
        $grandTotal = ($subtotal - $discount) + $orderData['shipping'];
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

        Mail::to($useremail)->queue(new OrderConformation($username, $useremail, $useradress, $grandTotal, $userphone, $subtotal, $cartItems));

        $orderDetails = [
            'orderId' => $order->id,
            'name' => $order->name,
            'email' => $order->email,
            'phone' => $order->phone,
            'address' => $order->address,
            'grand_total' => $grandTotal,            
        ];
        $admins = User::where('user_type', 'admin')->get();
        foreach ($admins as $admin) {
         $admin->notify(new NewOrderNotification($order));
        }
        // event(new OrderPlaced($order));
        return response()->json([
            'message' => 'Order placed successfully',
            'status' => true,
            'orderId' => $order->id,
            'orderDetails' => $orderDetails,
        ]);
    }
    public function thankYouPage($orderId)
    {
        $order =  Order::with(['user', 'country', 'items.product'])->find($orderId);

            if (!$order) {
                return redirect()->route('orders.index')->with('error', 'Order not found.');
            }

            // Decode product images and set the first image
            foreach ($order->items as $item) {
                $images = json_decode($item->product->images, true);
                $item->product->images = $images[0] ?? 'default-image.jpg';
            }
        return view('website.thankyou', compact('order'));
    }

    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }
    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }


    public function getShippingCharge(Request $request)
    {
        // Initialize variables
        $subtotal = 0;
        $totalShippingCharge = 0;
        $discount = 0;  // Default discount is zero

        // Check if a coupon code exists in the session

        $cartItems = [];

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
                    $cartItems[] = (object) [
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'weight' => $product->weight,
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
            $weight = $item->weight;

            // Get the shipping charge for the unit of this product
            $shippingChargeForUnit = ShippingCharge::where('unit_id', $item->unit_id)
                ->where('city_id', $request->city_id)
                ->first();

            if ($shippingChargeForUnit) {
                $weightCharge = $shippingChargeForUnit->charge * $weight;
                $totalShippingCharge += $weightCharge * $qty;
            } else {
                // Default shipping charge if no specific rate is found
                $totalShippingCharge += 10;
            }
        }
        $coupon = 0;
        if (session()->has('code')) {
            $code = session()->get('code');
            $discount = ($code->percentage / 100) * $subtotal;
            $coupon = $code->coupon;
        }

        // Apply the discount after calculating the subtotal
        $subtotal = $subtotal - $discount;

        // Calculate the grand total
        $grand_total = $subtotal + $totalShippingCharge;

        // Return the response with the calculated values
        return response()->json([
            'status' => true,
            'discount' => $discount,
            'subtotal' => $subtotal,
            'grand_total' => $grand_total,
            'shippingCharge' => $totalShippingCharge,
            'coupon' => $coupon
        ]);
    }


    public function applyCoupon(Request $request)
    {
        // Fetch the coupon from the database
        $code = Affiliate::where('coupon', $request->code)
            ->where('status', 1) // Ensure the coupon is active
            ->first();

        // Check if the coupon exists
        if ($code == null) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Coupon Code',
            ]);
        }

        // Save the coupon code in session for future use
        session()->put('code', $code);

        // Now, recalculate the shipping charge with the coupon applied
        return $this->getShippingCharge($request);
    }


}
