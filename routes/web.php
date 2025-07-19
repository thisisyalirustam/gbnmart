<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminMainController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\orders\OrderMainContrller;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\ProdcutSubCategoryController;
use App\Http\Controllers\admin\ProductBrandController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\ProductCollection;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductMainController;
use App\Http\Controllers\admin\settings\NotificationController;
use App\Http\Controllers\admin\settings\SettingsMainController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\suplair\SuplairController;
use App\Http\Controllers\website\BuyerDashboadController;
use App\Http\Controllers\website\CartController;
use App\Http\Controllers\website\WebController;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsBuyer;
use Illuminate\Support\Facades\Route;


Route::get('/wishlist', [CartController::class, 'getWishlist'])->name('wishlist.show');
//Route::get('/dashboard',[BuyerDashboadController::class,'dash'])->middleware(['auth','verified'])->name('dashboard');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::get('/cart-option', [CartController::class, 'checkoption'])->name('option.show');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::get('/collection/{slug}', [WebController::class, 'collectionProduct'])->name('web.product.collection');

// Buyer Dashboard
Route::middleware(['auth', EnsureUserIsBuyer::class])->group(function () {
    Route::get('/dashboard', [BuyerDashboadController::class, 'dash'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard/orderproduct/{id}', [BuyerDashboadController::class, 'orderproduct'])->name('website.orderproduct');
    Route::get('/buyer/account', [BuyerDashboadController::class, 'account'])->name('website.account');
    Route::get('/affliate', [BuyerDashboadController::class, 'affliate'])->name('website.affliate');
    Route::get('affliate/applay/', [BuyerDashboadController::class, 'applayAffliate'])->name('website.affliate.applay');
    Route::post('/affliate/bankdetails', [BuyerDashboadController::class, 'affliateStore'])->name('website.affliate.store');
    Route::post('/affliate/savebankdetails', [BuyerDashboadController::class, 'saveBankDetails'])->name('website.affliate.storeBankDetails');
});

// Admin routes
Route::middleware(['auth', 'verified', EnsureUserIsAdmin::class])->group(function () {
    //admin Dashboard Routs
    Route::get('/admin-dashboard', [WebController::class, 'admin'])->name('admin');
    Route::get('/admin-graph-data', [ProductMainController::class, 'getGraphData'])->name('admin.getGraphData');
    Route::get('/admin-revenue-data', [ProductMainController::class, 'getRevenueDetails'])->name('admin.getRevenueDetails');
    Route::get('/admin-customer-data', [ProductMainController::class, 'getCustomerDetails'])->name('admin.getCustomerDetails');
    Route::get('/recent-product', [ProductMainController::class, 'getProduct']);
    Route::get('/admin-dashboard-data', [ProductMainController::class, 'getOrderDetails'])->name('admin.getDetails');
    Route::get('/show-data', [AdminController::class, 'showuser'])->name('showdata');
    //user managment Routs
    Route::resource('/add-user', UserController::class);

    //product managment Routes
    Route::get('/product_dashboard', [AdminController::class, 'product_dashboard'])->name('admin.product_dashboard');
    Route::resource('/product', ProductController::class);
    Route::resource('/product-cat', ProductCategoryController::class);
    Route::get('/product_category', [AdminController::class, 'showproductcat'])->name('p_cat');
    Route::resource('/product-sub-cat', ProdcutSubCategoryController::class);
    Route::get('/show_p_sub_cat', [AdminController::class, 'product_sub_cat'])->name('p_sub_cat');
    Route::resource('/product-brand', ProductBrandController::class);
    Route::get('/show_product_brand', [AdminController::class, 'product_brand'])->name('p_brand');
    Route::post('/product/{id}/delete-image', [ProductController::class, 'deleteImage'])->name('product.deleteImage');
    Route::get('/show_product', [AdminController::class, 'product'])->name('product');
    Route::get('/create_product', [AdminMainController::class, 'product_add'])->name('product_create');
    Route::get('/get-subcategories-brands/{categoryId}', [AdminMainController::class, 'getSubcategoriesAndBrands'])->name('getSubcategoriesAndBrands');
    Route::post('/product/{id}/status', [AdminMainController::class, 'updateStatus'])->name('product.updateStatus');
    Route::post('/product/{id}/sof', [AdminMainController::class, 'updateSOF'])->name('product.updateSOF');

    // collections
    Route::post('/products/assign-collections', [ProductCollection::class, 'assignCollections'])
        ->name('products.assign-collections');
    Route::get('/products/collections', [ProductCollection::class, 'index'])->name('products.collection.index');
    Route::post('/collections_store', [ProductCollection::class, 'store'])->name('collections.store');
    Route::put('/collections_update/{id}', [ProductCollection::class, 'update'])->name('collections.update');
    Route::delete('/collections_delete/{id}', [ProductCollection::class, 'destroy'])->name('collections.destroy');
    Route::get('/getcollection', [ProductCollection::class, 'getCollection'])->name('collections.get');
    Route::get('/collections_update/{id}', [ProductCollection::class, 'show'])->name('collections.show');
    Route::get('/collection/{id}/products', [ProductCollection::class, 'showProducts']);
    Route::delete('/collection/{collection}/product/{product}', [ProductCollection::class, 'removeProduct'])
        ->name('collection.product.remove');

    //shipping Routes
    Route::resource('/shipping', ShippingController::class);
    Route::get('/shiping-show', [AdminController::class, 'shipping'])->name('admin.shipingshow');
    Route::get('/get-states/{country_id}', [AdminController::class, 'getStates'])->name('shipping.getStates');
    Route::get('/get-cities/{state_id}', [AdminController::class, 'getCities'])->name('shipping.getCities');

    //orders Routes
    Route::resource('/coustomer-orders', OrderController::class);
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('orders/all', [OrderMainContrller::class, 'ordersAll'])->name('order.all');
    Route::get('/orders/return', [OrderMainContrller::class, 'ordersReturn'])->name('order.return');
    Route::get('/orders/active', [OrderMainContrller::class, 'ordersActive'])->name('order.active');
    Route::get('/orders/returnJson', [OrderMainContrller::class, 'OrderReturnJson']);
    Route::get('/orders/compeleteJson', [OrderMainContrller::class, 'OrderCompeleteJson']);
    Route::get('/orders/activeJson', [OrderMainContrller::class, 'OrderActiveJson']);
    Route::get('/orders/compelete', [OrderMainContrller::class, 'ordersCompelete'])->name('order.compelete');
    Route::get('/orders/admin', [OrderMainContrller::class, 'ordersAdmin'])->name('order.admin');
    Route::post('/orders-show/{id}', [AdminController::class, 'showorder'])->name('admin.ordersshow');
    Route::post('orders/{orderId}/send-invoice', [AdminController::class, 'sendInvoice'])->name('orders.sendInvoice');
    Route::get('/update-order/{id}', [AdminController::class, 'updateOrder'])->name('orderUpdate');
    Route::get('/quick-show/{id}', [AdminMainController::class, 'quickShow'])->name('quickshow');
    Route::post('/customer-orders/{id}/update-delivery-date', [AdminController::class, 'updateDeliveryDate'])->name('orders.updateDeliveryDate');
    Route::post('/customer-orders/{id}/{coupon}/update-shipping-status', [AdminController::class, 'updateShippingStatus'])->name('orders.updateShippingStatus');
    Route::get('/orders/rating/', [OrderMainContrller::class, 'getRatingAndReview']);
    Route::get('/orders/rating-review/', [OrderMainContrller::class, 'showRatingAndReview'])->name('admin.rating_review');
    Route::patch('/update-status/{id}', [OrderMainContrller::class, 'updateStatus']);
    Route::delete('delete-order/{id}', [OrderMainContrller::class, 'deleteOrder'])->name('delete-order');
    //settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.setting');
    Route::put('/update-settings/{id}', [SettingsController::class, 'updateSetting'])->name('setting.update');
    Route::resource('/settings/banners', BannerController::class);
    Route::get('admin/settings_dashboard', [SettingsMainController::class, 'index'])->name('admin.settings.dashboard');
    //Affliates Routes
    Route::get('/affiliate/dashboard', [AdminController::class, 'affiliateget'])->name('affiliate.index');
    Route::get('/affiliate/active-marketers', [AdminController::class, 'activeMarketers'])->name('affiliate.active');
    Route::post('/affiliate/send-funds', [AdminController::class, 'sendFunds']);
    Route::post('/affiliate/approve', [AdminController::class, 'approveAffiliate']);
    Route::post('/affiliate/deactivate', [AdminController::class, 'deactivateAffiliate']);
    Route::delete('/affiliate/delete/{id}', [AdminController::class, 'deleteAffliate'])->name('affiliate.delete');
    //notification
    // Route::post('/notifications/mark-as-read', [AdminController::class, 'markAsRead'])->name('notifications.markAsRead');
    // Route::get('/notifications/fatch', [AdminController::class, 'getNotifications'])->name('notifications.get');

    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::get('/admin/profile', [AdminMainController::class, 'getProfile'])->name('admin.profile');
    Route::post('/profile/update', [AdminMainController::class, 'update'])->name('profile.update');
    Route::post('/change-password', [AdminMainController::class, 'changePassword'])->name('change.admin.password');

    Route::get('/Blogs', [BlogController::class, 'index'])->name('admin.blog');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('admin.blog.create');

});

//vendor Routs
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/supplier-Dashboard', [SuplairController::class, 'index'])->name('supplier.auth');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/websit.php';
