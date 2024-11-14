<?php

use App\Http\Controllers\website\CartController;
use App\Http\Controllers\website\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/',[WebController::class, 'home'])->name('homepage');
Route::get('/shop/{catslug?}/{subcatslug?}', [WebController::class, 'shop'])->name('shoppage');

Route::get('/{slug:slug}', [WebController::class, 'productDetail'])->name('product.detail');

Route::get('/admin-dashboard',[WebController::class, 'admin'])->name('admin');

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/cart-count', [CartController::class, 'index'])->name('cart.count');
Route::post('/cart/update-quantity/{productId}', [CartController::class, 'updateQuantity'])->name('cart.update.quantity');
Route::post('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');



