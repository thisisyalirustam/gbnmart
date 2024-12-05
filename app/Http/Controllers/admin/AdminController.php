<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderInvoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCat;
use App\Models\ProductSubCategory;
use App\Models\ShippingCharge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function index()
    {


        return view('admin.pages.dashboard.index');
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
    public function shipping(){
        $shipping = ShippingCharge::with('country', 'state', 'city')->get();
        return response()->json($shipping);
    }
    public function orders(){
        $order = Order::orderBy('id', 'desc')->get();
        return response()->json($order);


    }
    public function updateDeliveryDate(Request $request, $id)
    {


        // Find the order by ID and update the delivery date
        $order = Order::findOrFail($id);
        $order->delivered_date = $request->delivered_date;
        $order->save();

        return redirect()->back()->with('success', 'Delivery date updated successfully!');
    }




    public function updateShippingStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);
    $order->shipping_status = $request->shipping_status;
    $order->save();

    return redirect()->back()->with('success', 'Delivery date updated successfully!');
}


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
        $orderData['grand_total'] += $item->price * $item->quantity;
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



// public function sendInvoice($orderId)
// {
//     // Retrieve the order with the necessary relationships
//     $ordershow = Order::with(['user', 'country', 'items.product'])->find($orderId);

//     // Initialize order data array
//     $orderData = [
//         'username' => $ordershow->name, // Assuming 'user' relationship exists
//         'items' => [],
//         'grand_total' => 0, // Grand total of the order
//         'order_id' => $ordershow->id,
//         'order_date' => $ordershow->created_at->toFormattedDateString(), // Date of order
//         'shipping_address' => $ordershow->address ?? 'Not provided', // User's shipping address
//         'country' => $ordershow->country->name ?? 'Not specified', // Country name
//     ];

//     // Loop through each item in the order
//     foreach ($ordershow->items as $item) {
//         $images = json_decode($item->product->images, true);
//         $item->product->images = $images[0] ?? 'default-image.jpg';

//         // Calculate the subtotal for the item
//         $subtotal = $item->price * $item->quantity;

//         // Add item data to order
//         $orderData['items'][] = [
//             'name' => $item->product->name,
//             'image' => $item->product->images,
//             'quantity' => $item->quantity,
//             'price' => number_format($item->price, 2), // Format price
//             'subtotal' => number_format($subtotal, 2), // Format subtotal
//         ];

//         // Add to the grand total
//         $orderData['grand_total'] += $subtotal;
//     }

//     // Format grand total as currency
//     $orderData['grand_total'] = number_format($orderData['grand_total'], 2);

//     // Send the invoice (using a mail service, assuming Mail class is set up)
//     Mail::to($ordershow->email)->send(new OrderInvoice($orderData));

//     // Return a success response
//     return response()->json(['status' => 'Invoice sent successfully!', 'order_id' => $orderId]);
// }


}
