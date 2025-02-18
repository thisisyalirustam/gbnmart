<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\website\BuyerDashboadController;
use App\Http\Controllers\website\CartController;
use App\Http\Controllers\website\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/',[WebController::class, 'home'])->name('homepage');
Route::get('/shop/{catslug?}/{subcatslug?}', [WebController::class, 'shop'])->name('shoppage');

Route::get('/{slug:slug}', [WebController::class, 'productDetail'])->name('product.detail');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/cart-count', [CartController::class, 'index'])->name('cart.count');
Route::post('/cart/update-quantity/{productId}', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
Route::post('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'processOrder'])->name('checkout.process');
Route::get('/thank-you/{orderId}', [CheckoutController::class, 'thankYouPage'])->name('checkout.thankyou');
Route::get('/get-states/{country_id}', [CheckoutController::class, 'getStates']);
Route::get('/get-cities/{state_id}', [CheckoutController::class, 'getCities']);
Route::post('/checkout/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');

Route::post('/wishlist-add', [CartController::class, 'addWishlist'])->name('wishlist.add');
Route::get('/wishlist-count', [CartController::class, 'wishlistShow'])->name('wishlist.count');
// routes/web.php
Route::get('/wishlist/count', [CartController::class, 'getWishlistCount'])->name('wishlist.count');
// In routes/web.php
Route::post('/get-shipping-charge', [CheckoutController::class, 'getShippingCharge'])->name('get.shipping.charges');





