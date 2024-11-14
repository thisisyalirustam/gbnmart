<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    // MainController or BaseController
    public function index()
    {
        $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->sum('quantity') : array_sum(array_column(session('cart', []), 'quantity'));
        $data = [
            'cartCount' => $cartCount,

        ];

        return view('website.component.header', $data);
    }


    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        if (Auth::check()) {
            $userId = Auth::id();
            $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

            if ($cartItem) {
                return response()->json(['error' => 'Product is already in your cart.'], 409);
            } else {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                return response()->json(['error' => 'Product is already in your cart.'], 409);
            } else {
                $cart[$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ];
                session()->put('cart', $cart);
            }
        }
        return response()->json(['success' => 'Product added to your cart.', 'count' => $this->getCartCount()]);
    }



    private function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        }
        $cart = session()->get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }


    public function showCart()
    {
        $cartItems = [];
        $subtotal = 0;

        if (Auth::check()) {
            $userId = Auth::id();
            $cartItems = Cart::where('carts.user_id', Auth::id()) // Specify the table for user_id
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->get(['products.id as product_id', 'products.name', 'products.price', 'carts.quantity', 'products.description', 'products.images']);

        } else {
            $sessionCart = session('cart', []);
            foreach ($sessionCart as $productId => $item) {
                $product = Product::find($productId);
                if ($product) {
                    $cartItems[] = (object)[
                        'product_id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $item['quantity'],
                        'description' => $product->description,
                        'images' => $product->images
                    ];
                }
            }
        }

        // Calculate subtotal
        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->quantity;
            // Decode images JSON and set first image as a property
            $images = json_decode($item->images, true);
            $item->first_image = $images[0] ?? null;
        }

        return view('website.cart', compact('cartItems', 'subtotal'));
    }
  // Remove from Cart
  public function removeFromCart($productId)
  {
      if (Auth::check()) {
          Cart::where('user_id', Auth::id())->where('product_id', $productId)->delete();
      } else {
          $cart = session()->get('cart', []);
          unset($cart[$productId]);
          session()->put('cart', $cart);
      }

      return redirect()->route('cart.show')->with('success', 'Product removed from cart');
  }

  // Update Quantity
  public function updateQuantity(Request $request, $productId)
{
    $quantity = $request->input('quantity');

    if (Auth::check()) {
        $cartItem = Cart::where('user_id', Auth::id())->where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }
    } else {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
    }

    // Calculate the updated item total and subtotal
    $itemTotal = $quantity * Product::find($productId)->price;
    $subtotal = $this->calculateSubtotal();

    return response(json_encode(['itemTotal' => $itemTotal, 'subtotal' => $subtotal]), 200)
            ->header('Content-Type', 'application/json');

}


  // Calculate Subtotal
  private function calculateSubtotal()
  {
      $subtotal = 0;

      if (Auth::check()) {
        $cartItems = Cart::where('carts.user_id', Auth::id()) // Specify the table name to avoid ambiguity
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->get(['products.price', 'carts.quantity']);
          foreach ($cartItems as $item) {
              $subtotal += $item->price * $item->quantity;
          }
      } else {
          $sessionCart = session('cart', []);
          foreach ($sessionCart as $productId => $item) {
              $product = Product::find($productId);
              if ($product) {
                  $subtotal += $product->price * $item['quantity'];
              }
          }
      }

      return $subtotal;
  }

}
