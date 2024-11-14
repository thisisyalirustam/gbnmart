<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminMainController;
use App\Http\Controllers\admin\ProdcutSubCategoryController;
use App\Http\Controllers\admin\ProductBrandController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\suplair\SuplairController;
use App\Http\Controllers\website\CartController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::middleware(['auth','user_type:buyer'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.auth');
    Route::resource('/add-user',UserController::class);
    Route::get('/show-data',[AdminController::class,'showuser'])->name('showdata');

    Route::resource('/product-cat',ProductCategoryController::class);
    Route::get('/product_category',[AdminController::class,'showproductcat'])->name('p_cat');

    Route::resource('/product-sub-cat',ProdcutSubCategoryController::class);
    Route::get('/show_p_sub_cat',[AdminController::class,'product_sub_cat'])->name('p_sub_cat');

    Route::resource('/product-brand',ProductBrandController::class);
    Route::get('/show_product_brand',[AdminController::class,'product_brand'])->name('p_brand');

    Route::resource('/product',ProductController::class);
    Route::get('/show_product',[AdminController::class,'product'])->name('product');
    Route::get('/create_product',[AdminMainController::class,'product_add'])->name('product_create');
    Route::get('/get-subcategories-brands/{categoryId}', [AdminMainController::class, 'getSubcategoriesAndBrands'])->name('getSubcategoriesAndBrands');
    Route::post('/product/{id}/status', [AdminMainController::class, 'updateStatus'])->name('product.updateStatus');
    Route::post('/product/{id}/sof', [AdminMainController::class, 'updateSOF'])->name('product.updateSOF');


});

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/supplier-Dashboard', [SuplairController::class, 'index'])->name('supplier.auth');

});

require __DIR__.'/auth.php';
require __DIR__.'/websit.php';
