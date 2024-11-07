<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        return response()->json(['message' => 'This is a test response']);
        // $product_id = $request->product_id;
        // $quantity = $request->quantity;
        // $cart = session()->get('cart', []);

        // if(isset($cart[$product_id])) {
        //     $cart[$product_id]['quantity'] += $quantity;
        // } else {
        //     $cart[$product_id] = [
        //         "name" => $request->name,
        //         "quantity" => $quantity,
        //         "price" => $request->price
        //     ];
        // }

        // session()->put('cart', $cart);
        // return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function removeFromCart(Request $request)
    {
        $product_id = $request->product_id;
        $cart = session()->get('cart', []);

        if(isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed successfully!');
    }

    public function updateCart(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $cart = session()->get('cart', []);

        if(isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', ['cart' => $cart]);
    }
}
