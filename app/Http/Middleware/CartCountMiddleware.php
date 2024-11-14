<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class CartCountMiddleware
{
    public function handle($request, Closure $next)
    {
        // Calculate the cart count based on user authentication
        $cartCount = Auth::check()
            ? Cart::where('user_id', Auth::id())->sum('quantity')
            : array_sum(array_column(session('cart', []), 'quantity'));

        // Share `$cartCount` with all views
        View::share('cartCount', $cartCount);

        return $next($request);
    }
}
