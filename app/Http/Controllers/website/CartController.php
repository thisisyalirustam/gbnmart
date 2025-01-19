<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

  public function checkoption(){
    return view('website.middlepage');
  }

  public function wishlistShow(){
    $wishlistCount = Auth::check() ? Wishlist::where('user_id', Auth::id())->sum('product_id') : array_sum(array_column(session('wishlist', []), 'product_id'));
    $data = [
        'wishlistCount' => $wishlistCount,
    ];

    return view('website.component.header', $data);
  }

  public function addWishlist(Request $request)
  {
      $productId = $request->input('product_id');
      if (Auth::check()) {
          $userId = Auth::id();
          $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();

          if ($wishlist) {
              return response()->json(['error' => 'This Product is Already In Your Wishlist.'], 409);
          } else {
              Wishlist::create([
                  'user_id' => $userId,
                  'product_id' => $productId,
              ]);

              // Return updated wishlist count after adding a product
              return response()->json(['success' => 'Product added to your wishlist via table.', 'count' => $this->wishlistCount()]);
          }
      } else {
          $wishlist = session()->get('wishlist', []);
          if (isset($wishlist[$productId])) {
              return response()->json(['error' => 'Product is already in your Wishlist.'], 409);
          } else {
              $wishlist[$productId] = [
                  'product_id' => $productId,
              ];
              session()->put('wishlist', $wishlist);

              // Return updated wishlist count after adding a product
              return response()->json(['success' => 'Product added to your wishlist via session.', 'count' => $this->wishlistCount()]);
          }
      }
  }

  public function wishlistCount()
  {
    $wishlistCount = Auth::check()
        ? Wishlist::where('user_id', Auth::id())->count()  // Count the number of wishlist items for logged-in users
        : count(session('wishlist', [])); // Count the items in session for non-logged-in users

    return response()->json(['count' => $wishlistCount]);
   }

   public function getWishlist()
   {
       $wishlist = session()->get('wishlist', []);

       if (Auth::check()) {
           $userId = Auth::id();
           $wishlist = Wishlist::with('product')->where('user_id', $userId)->get();
       } else {
           if (!empty($wishlist)) {
               $productIds = array_column($wishlist, 'product_id');
               $wishlist = Product::whereIn('id', $productIds)->get();
           } else {
               $wishlist = collect(); // If no products in session
           }
       }

       return view('website.wishlist', compact('wishlist'));
   }





}
