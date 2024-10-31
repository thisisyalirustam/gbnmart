<?php

use App\Http\Controllers\website\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/',[WebController::class, 'home'])->name('homepage');
Route::get('/shop/{catslug?}/{subcatslug?}', [WebController::class, 'shop'])->name('shoppage');

Route::get('/{slug:slug}', [WebController::class, 'productDetail'])->name('product.detail');

Route::get('/admin-dashboard',[WebController::class, 'admin'])->name('admin');

