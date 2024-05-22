<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\UserController;
use App\Models\CustomerPackage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', function () {

        return view('admin.index');

    })->name('admin.dashboard')->middleware('auth:admin');
});

//user route
Route::post('/user/register/store', [UserController::class, 'StoreUserRegister'])->name('register.store');
Route::put('/customer/update/{user}', [UserController::class, 'updateUser'])->name('customer.update');
// Route::get('/otp/verify', [OTPValidationController::class, 'showVerificationForm'])->name('otp.verify');
// Route::post('/otp/validate', [OTPValidationController::class, 'validateOTP'])->name('otp.validate');
Route::get('/', [IndexController::class, 'Index'])->name('home');
Route::get('/storage-calculator', [IndexController::class, 'storageCalc'])->name('storage.calculator');
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('user.change.password');
Route::post('/user/update/password', [IndexController::class, 'UserUpdatePassword'])->name('user.update.password');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $id = Auth::user()->id;
        $user = User::find($id);
        $quotations = CustomerPackage::with('user')
            ->where('customer_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->get();
// dd($quotations);
        return view('dashboard', compact('user', 'quotations'));
    })->name('dashboard');
});

// //all frontend route
// route::get('/language/hindi',[LanguageController::class,'Hindi'])->name('hindi.language');
// route::get('/language/english',[LanguageController::class,'English'])->name('english.language');
// //product details route

//product tags route
route::get('/product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);
route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'user'], function () {
    // route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');

    //Payment all route
    route::post('/stripe/order/', [StripeController::class, 'StripeOrder'])->name('stripe.order');
    route::post('/cash/order/', [CashController::class, 'CashOrder'])->name('cash.order');

    //order route
    Route::get('/my/oders', [AllUserController::class, 'MyOrders'])->name('my.orders');
    Route::get('/order-details/{order_id}', [AllUserController::class, 'OrderDetails']);
    Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);
    route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');
    route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.oder.list');
    Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');
    route::post('/order/tracking', [AllUserController::class, 'OrderTracking'])->name('order.tracking');
});

//not use//

route::get('/cart_remove/{rowId}', [CartPageController::class, 'RemoveCart'])->name('user-remove-cart');
route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);
route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);
//all coupon route...................
// route::post('/coupon-apply', [CartController::class, 'CouponApply']);
route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
// route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

//end not use//

//all checkout route
route::get('/district-get/ajax/{id}', [CheckoutController::class, 'LoadDistrict']);
route::get('/state-get/ajax/{id}', [CheckoutController::class, 'LoadState']);
route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

//all search product route....
route::get('/product/search/{search?}', [IndexController::class, 'AllSearchResult'])->name('product.search.all');
route::get('/search', [IndexController::class, 'ProductSearch'])->name('product.search');
route::post('search-product', [IndexController::class, 'SearchProduct']);

Route::get('/barcode', [ProductController::class, 'GenerateBarcode']);

Route::get('/test', function () {
    return view('backend.sale.sale_report'); // Replace 'your.view.name' with the actual path to your view file
});

route::get('/frontend/district/ajax/{id}', [ShippingAreaController::class, 'getDistrict'])->name('get-district-fronted');
route::get('/frontend/state/ajax/{id}', [ShippingAreaController::class, 'getStateById'])->name('get-state-fronted');

Route::get('/{type}/{id}', [ReportController::class, 'QuotationAndSaleInvoiceReport'])->name('user.invoice.report');


require __DIR__.'/backend.php';
require __DIR__.'/frontend.php';
require __DIR__.'/landingPage.php';
