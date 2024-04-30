<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CurrencyController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\MultiImageController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\PackageItemController;
use App\Http\Controllers\Backend\ProductBarcodeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\QuotationController;
use App\Http\Controllers\Backend\QuotationItemController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\RolePermissionController;
use App\Http\Controllers\Backend\SaleController;
use App\Http\Controllers\Backend\SeoSettingController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SocialMediaSettingController;
use App\Http\Controllers\Backend\SpecificationController;
use App\Http\Controllers\Backend\SpecificationDetailController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\SubsubcategoryController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\UserDetailsController;
use App\Http\Controllers\Backend\UserManagementController;
use App\Http\Controllers\Backend\VendorController;
use Illuminate\Support\Facades\Route;

route::middleware(['auth:admin'])->group(function () {

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/update/change/password', [AdminProfileController::class, 'AdminUpdateChangePassword'])->name('update.change.password');

    //brand
    Route::resource('brand', BrandController::class);
    Route::post('/brand/active/{id}', [BrandController::class, 'ActiveBrand'])->name('active.brand');
    Route::post('/brand/inactive/{id}', [BrandController::class, 'InactiveBrand'])->name('inactive.brand');

    //slider
    Route::resource('slider', SliderController::class);
    Route::post('/slider/active/{id}', [SliderController::class, 'ActiveSlider'])->name('active.slider');
    Route::post('/slider/inactive/{id}', [SliderController::class, 'InactiveSlider'])->name('inactive.slider');

    //coupon
    Route::resource('coupon', CouponController::class);
    Route::post('/coupon/active/{id}', [CouponController::class, 'ActiveCoupon'])->name('active.coupon');
    Route::post('/coupon/inactive/{id}', [CouponController::class, 'InactiveCoupon'])->name('inactive.coupon');

    //currency
    Route::resource('currency', CurrencyController::class);
    Route::post('/currency/active/{id}', [CurrencyController::class, 'ActiveCurrency'])->name('active.currency');

    //expense
    Route::resource('expense', ExpenseController::class);

    //vendor
    Route::resource('vendor', VendorController::class);

        //user
    Route::resource('user', UserDetailsController::class);

    //site setting
    Route::resource('site-setting', SiteSettingController::class);

    //seo setting
    Route::resource('seo-setting', SeoSettingController::class);

    //social media setting
    Route::resource('social-media-setting', SocialMediaSettingController::class);
    Route::post('/social-media-setting/active/{id}', [SocialMediaSettingController::class, 'ActiveSocialMedia'])->name('active.social-media');
    Route::post('/social-media-setting/inactive/{id}', [SocialMediaSettingController::class, 'InactiveSocialMedia'])->name('inactive.social-media');

    //administrator
    route::prefix('administration')->group(function () {
        Route::resource('role', RoleController::class);
        Route::post('/role/active/{id}', [RoleController::class, 'ActiveRole'])->name('active.role');
        Route::post('/role/inactive/{id}', [RoleController::class, 'InactiveRole'])->name('inactive.role');

        Route::resource('role-permission', RolePermissionController::class);

        Route::resource('user-management', UserManagementController::class);
        Route::post('/user/active/{id}', [UserManagementController::class, 'ActiveUser'])->name('active.user');
        Route::post('/user/inactive/{id}', [UserManagementController::class, 'InactiveUser'])->name('inactive.user');

    });

    //Shipping Area all route
    route::prefix('shipping')->group(function () {
        route::get('/division/view', [ShippingAreaController::class, 'DivisionView'])->name('manage-division');
        route::post('/division/store', [ShippingAreaController::class, 'DivisionStore'])->name('division.store');
        route::post('/division/update/{id}', [ShippingAreaController::class, 'DivisionUpdate'])->name('division.update');
        route::get('/division/delete/{id}', [ShippingAreaController::class, 'DivisionDelete'])->name('division.delete');

        //Ship District  all route
        route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');
        route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');
        route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');
        route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');

        //Ship state  all route
        route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage-state');
        route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');
        route::post('/state/update', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');
        route::post('/state/delete', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');
        route::get('/district/ajax/{id}', [ShippingAreaController::class, 'getDistrict'])->name('get-district');
        route::get('/get-state-data', [ShippingAreaController::class, 'getState'])->name('get-state');
    });

    //categories
    route::prefix('productcatalog')->group(function () {
        Route::resource('category', CategoryController::class);
        Route::post('/category/active/{id}', [CategoryController::class, 'ActiveCategory'])->name('active.category');
        Route::post('/category/inactive/{id}', [CategoryController::class, 'InactiveCategory'])->name('inactive.category');

        //subcategory
        Route::resource('subcategory', SubCategoryController::class);
        Route::post('/subcategory/active/{id}', [SubcategoryController::class, 'ActiveSubcategory'])->name('active.subcategory');
        Route::post('/subcategory/inactive/{id}', [SubCategoryController::class, 'InactiveSubcategory'])->name('inactive.subcategory');

        //sub-subcategory
        Route::resource('subsubcategory', SubsubcategoryController::class);
        Route::post('/subsubcategory/active/{id}', [SubsubcategoryController::class, 'ActiveSubsubcategory'])->name('active.subsubcategory');
        Route::post('/subsubcategory/inactive/{id}', [SubsubcategoryController::class, 'InactiveSubsubcategory'])->name('inactive.subsubcategory');
    });

    //quotation
    route::prefix('dealflow')->group(function () {
        //package
        Route::resource('package', PackageController::class);
        Route::post('/package/active/{id}', [PackageController::class, 'ActivePackage'])->name('active.package');
        Route::post('/package/inactive/{id}', [PackageController::class, 'InactivePackage'])->name('inactive.package');

        //package item
        Route::resource('package-item', PackageItemController::class);

        //quotation
        Route::resource('quotation', QuotationController::class);
        Route::get('/search-quotation-list', [QuotationController::class, 'SearchQuotation'])->name('search.quotation');
        Route::get('/customer-latest-quotation/{id}', [QuotationController::class, 'CustomerLatestQuotation'])->name('customer-latest-quotation');
        Route::post('/update/quotation/product/{id}', [QuotationController::class, 'UpdateQuotationProduct'])->name('update.quotation.product');
        Route::post('/update/quotation/description/{id}', [QuotationController::class, 'UpdateQuotationProductDescription'])->name('update.quotation.description');
        Route::get('/quotation/{type}/{id}', [QuotationController::class, 'quotationEditOrInvoice'])->name('quotation-edit-or-invoice');
        Route::post('/store/quotation/invoice', [QuotationController::class, 'storeQuotationInvoice'])->name('store.quotation.invoice');
        //quotation
        Route::resource('quotation-item', QuotationItemController::class);
    });

    //product
    route::prefix('product')->group(function () {

        //specification item
        Route::resource('specification', SpecificationController::class);
        Route::post('/specification/active/{id}', [SpecificationController::class, 'ActiveSpecification'])->name('active.specification');
        Route::post('/specification/inactive/{id}', [SpecificationController::class, 'InactiveSpecification'])->name('inactive.specification');

        //specification item
        Route::resource('specification-detail', SpecificationDetailController::class);
        Route::post('/specification-detail/active/{id}', [SpecificationDetailController::class, 'ActiveSpecificationDetail'])->name('active.specification-detail');
        Route::post('/specification-detail/inactive/{id}', [SpecificationDetailController::class, 'InactiveSpecificationDetail'])->name('inactive.specification-detail');

        //product
        Route::resource('product', ProductController::class);
        Route::post('/active/{id}', [ProductController::class, 'ActiveProduct'])->name('active.product');
        Route::post('/inactive/{id}', [ProductController::class, 'InactiveProduct'])->name('inactive.product');

        //barcode
        Route::resource('barcode', ProductBarcodeController::class);
        Route::get('/barcode-print', [ProductBarcodeController::class, 'PrintBarcode'])->name('barcode.print');

        //multiimage
        Route::resource('multi-image', MultiImageController::class);
        // Route::get('/barcode-print', [ProductControllerRename::class, 'PrintBarcode'])->name('barcode.print');
        // route::post('/barcode-print-pdf', [ProductControllerRename::class, 'PrintBarcodePdf'])->name('barcode.pdf');

        //unit
        Route::resource('unit', UnitController::class);
        Route::post('/unit/active/{id}', [UnitController::class, 'ActiveUnit'])->name('active.unit');
        Route::post('/unit/inactive/{id}', [UnitController::class, 'InactiveUnit'])->name('inactive.unit');
    });

    //purchase route
    route::prefix('purchase')->group(function () {
        route::get('/create/purchase', [PurchaseController::class, 'CreatePurchase'])->name('create.purchase');
        route::get('/get/purchase/product/details', [PurchaseController::class, 'getProductDetails'])->name('get.purchase.product');
        route::post('/store-purchase-data-session', [PurchaseController::class, 'PurchaseDataSession'])->name('store.purchase-data-session');
        route::get('/get-purchase-data-session', [PurchaseController::class, 'getPurchaseDataSession'])->name('get.purchase-data-session');
        route::post('/store/purchase', [PurchaseController::class, 'StorePurchase'])->name('store.purchase');
        Route::get('/purchases/report', [PurchaseController::class, 'PurchaseReport'])->name('purchases.report');
        route::get('/view/purchase', [PurchaseController::class, 'ViewPurchase'])->name('view.purchase');
        route::get('/datewise-purchase-invoice', [PurchaseController::class, 'DateWisePurchase'])->name('datewise-purchase');

        route::get('/purchase/due/payment', [PurchaseController::class, 'PurchaseDueCollection'])->name('purchase-due-collection');
        route::get('/get/purchase/payment/history', [PurchaseController::class, 'PurchasePaymentHistory'])->name('purchase-payment-history');
        route::post('/purchase/make/due/payment', [PurchaseController::class, 'PurchaseDuePayment'])->name('purchase-due-payment');
    });

    //purchase route
    route::prefix('sale')->group(function () {
        route::get('/create/sale', [SaleController::class, 'CreateSale'])->name('create.sale');
        route::get('/get/sale/product/details', [SaleController::class, 'getProductDetails'])->name('get.sale.product');

        route::post('/store-sale-data-session', [SaleController::class, 'SaleDataSession'])->name('store.sale-data-session');
        route::get('/get-sale-data-session', [SaleController::class, 'getSaleDataSession'])->name('get.sale-data-session');
        route::post('/store/sale', [SaleController::class, 'StoreSale'])->name('store.sale');
        Route::get('/sales/report', [SaleController::class, 'SaleReport'])->name('sales.report');
        route::get('/view/sales', [SaleController::class, 'ViewSale'])->name('view.sale');
        route::get('/datewise-sale-invoice', [SaleController::class, 'DateWiseSale'])->name('datewise-sale');

        route::get('/sale/due/payment', [SaleController::class, 'SaleDueCollection'])->name('sale-due-collection');
        route::get('/get/sale/payment/history', [SaleController::class, 'SalePaymentHistory'])->name('sale-payment-history');
        route::post('/sale/make/due/payment', [SaleController::class, 'SaleDuePayment'])->name('sale-due-payment');
    });

    //reports route
    route::prefix('reports')->group(function () {
        Route::get('/create/purchases', [ReportController::class, 'CreatePurchaseReport'])->name('create.purchase-report');
        Route::get('/preview/purchases', [ReportController::class, 'PreviewPurchaseReport'])->name('preview.purchase-report');

        Route::get('/create/sales', [ReportController::class, 'CreateSaleReport'])->name('create.sale-report');
        Route::get('/preview/sales', [ReportController::class, 'PreviewSaleReport'])->name('preview.sale-report');

        Route::get('/create/inventory', [ReportController::class, 'CreateInventoryReport'])->name('create.inventory-report');
        Route::get('/preview/inventory', [ReportController::class, 'PreviewInventoryReport'])->name('preview.inventory-report');

        Route::get('/create/supplier', [ReportController::class, 'CreateSupplierReport'])->name('create.supplier-report');
        Route::get('/preview/suppliers', [ReportController::class, 'PreviewSupplierReport'])->name('preview.supplier-report');

        Route::get('/create/customer', [ReportController::class, 'CreateCustomerReport'])->name('create.customer-report');
        Route::get('/preview/customers', [ReportController::class, 'PreviewCustomerReport'])->name('preview.customer-report');

        Route::get('/create/expense', [ReportController::class, 'CreateExpenseReport'])->name('create.expense-report');
        Route::get('/preview/expense', [ReportController::class, 'PreviewExpenseReport'])->name('preview.expense-report');

        // Route::get('/quotation/report', [ReportController::class, 'QuotationReport'])->name('preview.quotation-report');
        Route::get('/{type}/{id}', [ReportController::class, 'QuotationAndSaleInvoiceReport'])->name('preview.quotation-or-invoice.report');
    });

    //admin all order routes
    route::prefix('orders')->group(function () {
        route::get('/pending/orders', [OrderController::class, 'PendingOrder'])->name('pending-orders');
        route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrderDetails'])->name('pending.orders.details');
        route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrder'])->name('confirmed-orders');
        route::get('/processing/orders', [OrderController::class, 'ProcessingOrder'])->name('processing-orders');
        route::get('/picked/orders', [OrderController::class, 'PickedOrder'])->name('picked-orders');
        route::get('/shipped/orders', [OrderController::class, 'ShippedOrder'])->name('shipped-orders');
        route::get('/delivered/orders', [OrderController::class, 'DeliveredOrder'])->name('delivered-orders');
        route::get('/cancel/orders', [OrderController::class, 'CancelOrder'])->name('cancel-orders');
        //update order status route
        route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');
        route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm-processing');
        route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing-picked');
        route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked-shipped');
        route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped-delivered');
        route::get('/delivered/cancel/{order_id}', [OrderController::class, 'DeliveredToCancel'])->name('delivered-cancel');
        route::get('/invoice/download/{order_id}', [OrderController::class, 'InvoiceDownload'])->name('invoice.download');
    });

    //admin all user handle routes
    route::prefix('user-management')->group(function () {
        route::get('/index', [UserDetailsController::class, 'index'])->name('user-management.index');

    });

    //not use those route............

    //all reports route
    route::prefix('reports')->group(function () {
        route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');
    });

    //all stock route
    route::prefix('stock')->group(function () {
        route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');
    });

    //all admin user role route
    // route::prefix('adminuserrole')->group(function () {
    //     route::get('/all', [AdminUserController::class, 'AllAdminRole'])->name('all.admin.user');
    //     route::get('/add', [AdminUserController::class, 'AddAdminRole'])->name('add.admin');
    //     route::post('/store', [AdminUserController::class, 'StoreAdminRole'])->name('admin.user.store');
    //     route::get('/edit/{id}', [AdminUserController::class, 'EditAdminRole'])->name('edit.admin.user');
    //     route::post('/update/{id}', [AdminUserController::class, 'UpdateAdminRole'])->name('admin.user.update');
    //     route::get('/delete/{id}', [AdminUserController::class, 'DeleteAdminRole'])->name('delete.admin.user');
    // });

});
