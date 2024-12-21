<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminMainController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\ProdcutSubCategoryController;
use App\Http\Controllers\admin\ProductBrandController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\suplair\SuplairController;
use App\Http\Controllers\website\BuyerDashboadController;
use App\Http\Controllers\website\CartController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard',[BuyerDashboadController::class,'dash'])->middleware(['auth','verified'])->name('dashboard');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/cart-option', [CartController::class, 'checkoption'])->name('option.show');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
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

    Route::resource('/shipping',ShippingController::class);
    Route::get('/shiping-show',[AdminController::class,'shipping'])->name('admin.shipingshow');
    Route::get('/get-states/{country_id}', [AdminController::class, 'getStates'])->name('shipping.getStates');
    Route::get('/get-cities/{state_id}', [AdminController::class, 'getCities'])->name('shipping.getCities');

    Route::resource('/coustomer-orders',OrderController::class);
    Route::get('/orders',[AdminController::class,'orders'])->name('admin.orders');
    Route::post('/orders-show/{id}',[AdminController::class,'showorder'])->name('admin.ordersshow');
    Route::post('orders/{orderId}/send-invoice', [AdminController::class, 'sendInvoice'])->name('orders.sendInvoice');

    Route::get('/settings',[SettingsController::class,'index'])->name('admin.setting');
    Route::put('/update-settings/{id}', [SettingsController::class, 'updateSetting'])->name('setting.update');
    Route::resource('/settings/banners', BannerController::class);

    Route::get('/affiliate/dashboard', [AdminController::class,'affiliateget'])->name('affiliate.index');
    Route::get('/affiliate/active-marketers', [AdminController::class,'activeMarketers'])->name('affiliate.active');



   // Update Delivery Date
Route::post('/customer-orders/{id}/update-delivery-date', [AdminController::class, 'updateDeliveryDate'])->name('orders.updateDeliveryDate');
Route::post('/customer-orders/{id}/update-shipping-status', [AdminController::class, 'updateShippingStatus'])->name('orders.updateShippingStatus');




});

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/supplier-Dashboard', [SuplairController::class, 'index'])->name('supplier.auth');




});

require __DIR__.'/auth.php';
require __DIR__.'/websit.php';
