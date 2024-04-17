<?php

use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\PackageController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\PurchaseController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\WishlistController;
use Illuminate\Support\Facades\Route;

//pages route
Route::get('/term&condition', [PagesController::class, 'TermsCondition'])->name('terms_condition');
Route::get('/about-us', [PagesController::class, 'AboutUs'])->name('about_us');
Route::get('/contact-us', [PagesController::class, 'ContactUs'])->name('contact_us');
Route::get('/faqs', [PagesController::class, 'FAQS'])->name('faqs');


//category wise data
route::get('category/product/{slug}/{category_id}', [IndexController::class, 'CategoryWiseProduct']);
route::get('brand_wise_category/product/{category_slug}/{category_id}/{brand_id}', [IndexController::class, 'CategoryBrandWiseProduct']);
route::get('subcategory/product/{slug}/{subcategory_id}', [IndexController::class, 'SubCategoryWiseProduct']);
route::get('brand_wise_subcategory/product/{subcategory_slug}/{subcategory_id}/{brand_id}', [IndexController::class, 'SubCategoryBrandWiseProduct']);
route::get('subsubcategory/product/{slug}/{subsubcategory_id}', [IndexController::class, 'SubSubCatWiseProduct']);
route::get('brand_wise_subsubcategory/product/{subsubcategory_id}/{brand_id}/{subsubcategory_slug}', [IndexController::class, 'SubSubCategoryBrandWiseProduct']);

//product details page
route::get('/product/details/{slug}/{product_id}', [IndexController::class, 'ProductDetails']);
route::get('/product/search/', [IndexController::class, 'AllSearchResult'])->name('all-search-result');



//Product view modal route 
route::post('/cart/data/store/', [CartController::class, 'AddToCart'])->name('add-to-cart');
route::get('get/cart/data', [CartController::class, 'getCartData'])->name('get-cart-data');
route::post('/remove-cart', [CartController::class, 'RemoveCart'])->name('remove-cart');
route::post('/apply-coupon', [CartController::class, 'ApplyCoupon'])->name('apply-coupon');
route::post('/remove-coupon', [CartController::class, 'RemoveCoupon'])->name('remove-coupon');


//all Cart route 
route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');
route::post('/cart-quantity-increase-decrease', [CartPageController::class, 'CartQtyIncreaseDecrease'])->name('cart-qty-increase-decrease');

//purchase
route::get('/checkout', [PurchaseController::class, 'Checkout'])->name('checkout');
route::post('/quick-buy/{id}', [PurchaseController::class, 'Buy'])->name('buy');
route::post('/apply-coupon-to-buy', [PurchaseController::class, 'ApplyCouponToBuy'])->name('coupon.buy');
route::get('/get-coupon-to-buy-data', [PurchaseController::class, 'getBuyingCouponData'])->name('get-buy-coupon-data');
route::post('/remove-buying-coupon-data', [PurchaseController::class, 'removeBuyingCouponData'])->name('remove-buying-coupon');

//wishlist
route::POST('/add-to-wishlist', [WishlistController::class, 'AddToWishlist'])->name('add-to-wishlist');
route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');
route::post('/wishlist_remove', [WishlistController::class, 'RemoveWishlist'])->name('remove-wishlist');



//quatation route
Route::get('/package-builder', [PackageController::class, 'ViewPackage'])->name('view.package');
Route::get('/package-details/{id}', [PackageController::class, 'ViewPackageDetails'])->name('view.packageDetails');
Route::get('/package-details-product/', [PackageController::class, 'ViewPackageDetailsProducts'])->name('view.packageDetailsProducts');
Route::get('/package-details/add-to-product/{product_id}/{package_id}/{key}', [PackageController::class, 'PackageDetailsAddProduct'])->name('addToProductPackage');
Route::get('/increase-decrease-package-quantity', [PackageController::class, 'IncreaseDecreasePackageQty'])->name('increase-decrease-package-qty');
Route::post('/remove-package-product', [PackageController::class, 'RemovePackageProduct'])->name('remove-package-product');
Route::get('/create/package-info/{id}', [PackageController::class, 'CreatePackage'])->name('frontend.create.package');
Route::post('/store/package-info/{id}', [PackageController::class, 'StorePackage'])->name('frontend.store.package');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('pay-now');

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END




//landing page route

