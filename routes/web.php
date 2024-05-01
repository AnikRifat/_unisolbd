<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProductController;
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

        $userID = Auth::guard('admin')->user()->id;

        // if (!session()->has('hierarchicalData')) {
        //     $rolePermissions = App\Models\RolePermission::select('role_permissions.*', 'modules.ordering as module_ordering', 'menus.ordering as menu_ordering', 'submenus.ordering as submenu_ordering', 'menus.prefix as menu_prefix', 'menus.route as menu_route')
        //         ->join('menus', 'role_permissions.menu_id', '=', 'menus.id')
        //         ->leftJoin('submenus', 'role_permissions.submenu_id', '=', 'submenus.id')
        //         ->join('modules', 'menus.module_id', '=', 'modules.id') // Join the 'modules' table
        //         ->with('module', 'menu', 'submenu', 'permission')
        //         ->whereIn('role_id', function ($query) use ($userID) {
        //             // Subquery to retrieve the role_ids from user_roles table based on the user_id
        //             $query
        //                 ->select('role_id')
        //                 ->from('user_roles')
        //                 ->where('user_id', $userID);
        //         })
        //         ->orderBy('module_ordering') // Use the alias for ordering
        //         ->orderBy('menu_ordering') // Use the alias for ordering
        //         ->orderBy('submenu_ordering') // Use the alias for ordering
        //         ->get();

        //     $hierarchicalData = [];
        //     foreach ($rolePermissions as $item) {
        //         $moduleName = $item->module ? $item->module->name : null;
        //         $menuName = $item->menu ? $item->menu->name : null;
        //         $submenuName = $item->submenu ? $item->submenu->name : null;
        //         $permissionId = $item->permission_id;
        //         $menuRoute = $item->menu ? $item->menu->route : null;
        //         $menuPrefix = $item->menu ? $item->menu->prefix : null;
        //         $submenuRoute = $item->submenu ? $item->submenu->route : null;
        //         // Create the module if it doesn't exist
        //         if (!isset($hierarchicalData[$moduleName])) {
        //             $hierarchicalData[$moduleName] = [
        //                 'id' => $item->module->id,
        //                 'icon' => $item->module->icon,
        //                 'bg_color' => $item->module->bg_color,
        //                 'menu' => [],
        //             ];
        //         }

        //         // Create the menu if it doesn't exist
        //         if (!isset($hierarchicalData[$moduleName]['menu'][$menuName])) {
        //             $hierarchicalData[$moduleName]['menu'][$menuName] = [
        //                 'icon' => $item->menu->icon,
        //                 'prefix' => $menuPrefix, // You can set this based on your data
        //                 'route' => $menuRoute,
        //                 'url' => $menuRoute != null ? route($menuRoute) : null,
        //                 'submenu' => [],
        //             ];
        //         }

        //         // Check if submenu is null or not
        //         if ($submenuName === null) {
        //             // Add the permission to the menu
        //             $hierarchicalData[$moduleName]['menu'][$menuName]['submenu'] = null;
        //             $hierarchicalData[$moduleName]['menu'][$menuName]['permissions'][] = $permissionId;
        //         } else {
        //             // Create the submenu if it doesn't exist
        //             if (!isset($hierarchicalData[$moduleName]['menu'][$menuName]['submenu'][$submenuName])) {
        //                 $hierarchicalData[$moduleName]['menu'][$menuName]['submenu'][$submenuName] = [
        //                     'route' => $submenuRoute,
        //                     'url' => route($submenuRoute),
        //                     'permissions' => [],
        //                 ];
        //             }

        //             // Add the permission to the submenu
        //             $hierarchicalData[$moduleName]['menu'][$menuName]['submenu'][$submenuName]['permissions'][] = $permissionId;
        //         }
        //     }

        //     session(['hierarchicalData' => $hierarchicalData]);
        // }

        // if (!empty(session('hierarchicalData'))) {
        //     $firstModuleName = key(session('hierarchicalData'));
        //     $activeModuleData = session('hierarchicalData')[$firstModuleName];

        //     // Set the active module with its key name in the session
        //     // $activeModuleWithKey = [$firstModuleName => $activeModuleData];
        //     session(['activeModule' => $activeModuleData]);
        // }

        //    return $activeModule = session('activeModule');

        //return $hierarchicalData = session('hierarchicalData');

        return view('admin.index');
    })->name('admin.dashboard')->middleware('auth:admin');
});

//user route
Route::post('/user/register/store', [UserController::class, 'StoreUserRegister'])->name('register.store');
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
        $quotations = CustomerPackage::with('vendor')
            ->where('customer_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->get();
        return view('dashboard', compact('user','quotations'));
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
route::get('/search', [IndexController::class, 'ProductSearch'])->name('product.search')->middleware(['user', 'auth']);
route::post('search-product', [IndexController::class, 'SearchProduct'])->middleware(['user', 'auth']);

Route::get('/barcode', [ProductController::class, 'GenerateBarcode']);

Route::get('/test', function () {
    return view('backend.sale.sale_report'); // Replace 'your.view.name' with the actual path to your view file
});

route::get('/frontend/district/ajax/{id}', [ShippingAreaController::class, 'getDistrict'])->name('get-district-fronted');
route::get('/frontend/state/ajax/{id}', [ShippingAreaController::class, 'getStateById'])->name('get-state-fronted');

require __DIR__.'/backend.php';
require __DIR__.'/frontend.php';
require __DIR__.'/landingPage.php';
