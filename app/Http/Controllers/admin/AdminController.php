<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderCompeleteMail;
use App\Mail\OrderInvoice;
use App\Models\Affiliate;
use App\Models\City;
use App\Models\Country;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\ShippingCharge;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index()
    {
        // return view('admin.pages.dashboard.index');
    }
    public function showuser()
    {
        $users = User::all()->map(function ($user) {
            if ($user->image) {
                // Ensure the image URL is correct
                $user->image = url('uploads/' . $user->image);
            }
            return $user;
        });

        return response()->json($users);
    }
    public function showproductcat()
    {
        $product_cat = ProductCat::orderBy('id', 'DESC')->get()->map(function ($category) {
            if ($category->image) {
                $category->image = url('images/category_img/' . basename($category->image));
            }
            return $category;
        });

        return response()->json($product_cat);
    }


    public function product_sub_cat()
    {
        $product_sub_cat = ProductSubCategory::with('product_cat')->get();
        return response()->json($product_sub_cat);
    }

    public function product_brand()
    {
        $brand = ProductBrand::with('product_cat')->get();
        return response()->json($brand);
    }
    public function product()
    {

        $products = Product::with('product_cat', 'product_sub_category', 'product_brand', 'user')
            ->get()
            ->map(function ($product) {
                if ($product->images) {
                    $images = json_decode($product->images, true);
                    if (is_array($images) && count($images) > 0) {
                        $product->image = url('images/products/' . basename($images[0]));
                    }
                }
                return $product;
            });

        return response()->json($products);
    }
    public function shipping()
    {
        $shipping = ShippingCharge::with('country', 'state', 'city', 'unit')->get();
        return response()->json($shipping);
    }
    public function orders()
    {
        $order = Order::orderBy('id', 'desc')->get();
        return response()->json($order);
    }
    public function updateDeliveryDate(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->delivered_date = $request->delivered_date;
        $order->save();

        return redirect()->back()->with('success', 'Delivery date updated successfully!');
    }

    public function updateShippingStatus(Request $request, $id, $coupon = null)
    {
        try {
            $order = Order::findOrFail($id);
            $order->shipping_status = $request->shipping_status;

            if ($request->shipping_status == 'Complete') {
                // Generate a unique review token
                $order->review_token = Str::random(60);
                $order->save();

                // Handle coupon logic
                $sub_total = $order->subtotal;
                $bonnes = 0;
                if ($coupon) {
                    $vendor = Affiliate::where('coupon', $coupon)->first();
                    if ($vendor) {
                        $bonnes = ($vendor->vendor_percentage / 100) * $sub_total;
                        $vendor->sales = $vendor->sales + 1;
                        $vendor->amount = $vendor->amount + $bonnes;
                        $vendor->save();
                    }
                }

                // Send email with review link
                $reviewLink = route('review.show', ['token' => $order->review_token]);
                Mail::to($order->email)->send(new OrderCompeleteMail($reviewLink));
            }

            $order->save();
            return redirect()->back()->with('success', 'Delivery date updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    // public function updateShippingStatus(Request $request, $id, $coupon = null)
    // {
    //     $order = Order::findOrFail($id);
    //     $order->shipping_status = $request->shipping_status;
    //     $order->save();
    //     $sub_total = $order->subtotal;
    //     $bonnes = 0;
    //     if ($request->shipping_status == 'Complete') {
    //         $order->review_token = Str::random(60);
    //         $order->save();
    //         if ($coupon) {
    //             $vendor = Affiliate::where('coupon', $coupon)->first();
    //             $bonnes = ($vendor->vendor_percentage / 100) * $sub_total;
    //             $vendor->sales = $vendor->sales + 1;
    //             $vendor->amount = $vendor->amount + $bonnes;
    //             $vendor->save();
    //         }
    //         $reviewLink = route('review.show', ['token' => $order->review_token]);
    //         Mail::to($order->email)->send(new OrderCompeleteMail($reviewLink));
    //     }

    //     return redirect()->back()->with('success', 'Delivery date updated successfully!');
    // }


    //     public function updateShippingStatus(Request $request, $id, $coupon = null)
//     {
//     $order = Order::findOrFail($id);
//     $order->shipping_status = $request->shipping_status;

    //     // Generate review token and send email if order is marked as "Complete"
//     if ($request->shipping_status == 'Complete') {
//         // Generate a unique review token
//         $order->review_token = Str::random(60);
//         $order->save();

    //         // Handle coupon logic
//         $sub_total = $order->subtotal;
//         $bonnes = 0;
//         if ($coupon) {
//             if ($coupon) {
//              $vendor = Affiliate::where('coupon', $coupon)->first();
//              $bonnes = ($vendor->vendor_percentage / 100) * $sub_total;
//              $vendor->sales = $vendor->sales + 1;
//              $vendor->amount = $vendor->amount + $bonnes;
//              $vendor->save();
//             }
//         }

    //         // Send email with review link
//         $reviewLink = route('review.show', ['token' => $order->review_token]);
//         Mail::to($order->email)->send(new OrderCompeleteMail($reviewLink));
//     }

    //     $order->save();
//     return redirect()->back()->with('success', 'Delivery date updated successfully!');
// }

    public function sendInvoice($orderId)
    {
        // Retrieve the order with the necessary relationships
        $ordershow = Order::with(['user', 'country', 'items.product'])->find($orderId);
        $orderData = [
            'username' => $ordershow->name,
            'order_id' => $ordershow->id,
            'email' => $ordershow->email,
            'address' => $ordershow->address,
            'city' => $ordershow->city,
            'shipping' => $ordershow->shipping,
            'phone' => $ordershow->phone,
            'zip' => $ordershow->zip,
            'state' => $ordershow->state,
            'items' => [],
            'grand_total' => 0, // Grand total of the order
            'payment_method_details' => '', // Add a place to store payment method details
        ];


        // Loop through order items to build item data
        foreach ($ordershow->items as $item) {
            $images = json_decode($item->product->images, true);
            $item->product->images = $images[0] ?? 'default-image.jpg';

            // Calculate item subtotal
            $subtotal = $item->price * $item->quantity;
            $orderData['items'][] = [
                'name' => $item->product->name,
                'image' => $item->product->image ?? 'default.jpg', // fallback image
                'price' => $item->price,
                'quantity' => $item->quantity,
                'subtotal' => $subtotal, // Add subtotal here
            ];
            $orderData['grand_total'] += $item->price * $item->quantity + $item->shipping;
        }

        // Handle payment method logic
        switch ($ordershow->payment_method) {
            case 'cash':
                $orderData['payment_method_details'] = 'Cash on Delivery. Delivery will be made upon payment.';
                break;
            case 'bank':
                $orderData['payment_method_details'] = 'Please make the payment via online bank transfer.';
                break;
            case 'credit':
                $orderData['payment_method_details'] = 'Please send payment to the following dummy bank details: Bank Name: Dummy Bank, SWIFT Code: DUMMY123';
                break;
            default:
                $orderData['payment_method_details'] = 'Payment method not specified.';
                break;
        }

        // Send the email with the populated order data
        Mail::to($ordershow->email)->send(new OrderInvoice($orderData));
    }

    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    // Fetch cities based on selected state
    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);
    }

    public function affiliateget()
    {
        return view('admin.pages.affiliate.dashboard');
    }
    public function activeMarketers()
    {
        $affiliate = Affiliate::with('user')->get();
        return view('admin.pages.affiliate.pages.active-marketers', compact('affiliate'));
    }
    public function deleteAffliate($id)
    {
        $affiliate = Affiliate::find($id);
        $affiliate->delete();
        return redirect()->back()->with('success', 'delete marketer');
    }


    public function approveAffiliate(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'affiliate_id' => 'required|exists:affiliates,id',
            'coupon_code' => 'nullable|string', // Make it nullable if it's optional
            'percentage' => 'required|numeric|min:0|max:100', // Validate percentage
            'vendor_percentage' => 'required|numeric|min:0|max:100', // Validate percentage
        ]);

        // Find the affiliate
        $affiliate = Affiliate::find($validated['affiliate_id']);
        if (!$affiliate) {
            return response()->json(['success' => false, 'message' => 'Affiliate not found']);
        }

        // Update the affiliate details
        $affiliate->status = 1; 
        $affiliate->coupon = $validated['coupon_code']; 
        $affiliate->percentage = $validated['percentage'];
        $affiliate->vendor_percentage = $validated['vendor_percentage'];
        $affiliate->save();

        return response()->json(['success' => true, 'message' => 'Affiliate Approved']);
    }

    // Controller Method for Sending Funds
    public function sendFunds(Request $request)
    {
        $validated = $request->validate([
            'affiliate_id' => 'required|exists:affiliates,id',
            'send_amount' => 'required|numeric|min:1',
        ]);

        $affiliate = Affiliate::findOrFail($request->affiliate_id);

        if ($affiliate->amount < $request->send_amount) {
            return response()->json(['success' => false, 'message' => 'Insufficient funds.']);
        }

        // Subtract the send amount from the affiliate's total amount
        $affiliate->amount -= $request->send_amount;
        $affiliate->withdrawal += $request->send_amount;
        $affiliate->save();

        return response()->json(['success' => true, 'message' => 'Funds sent successfully.']);
    }

    public function updateOrder(string $id)
    {
        $orderShow = Order::with(['user', 'country', 'state', 'city'])->find($id);
        $countries = Country::all();
        return view('admin.pages.orders.orders_update', compact('orderShow', 'countries'));
    }

    public function getNotifications()
      {
        $notifications = Auth::user()->notifications; // Fetch notifications for the authenticated user
        return response()->json($notifications);
      }

      public function product_dashboard(){
        $product_cont=Product::count();
        $product_cat=ProductCat::count();
        $product_brand=ProductBrand::count();
        return view('admin.pages.products.product_dashboard',compact('product_cont','product_cat','product_brand'));
      }

}
