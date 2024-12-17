@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ url('admin/dashboard') }}">
                    <!-- logo for regular state and mobile devices -->
                    <div class="d-flex align-items-center justify-content-center">
                        <h3><b>Hi {{ Auth::guard('admin')->user()->name }}</b> </h3>
                    </div>
                </a>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="{{ $route == 'dashboard' ? 'active' : '' }}">
                <a href="{{ url('admin/dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm320 96c0-26.9-16.5-49.9-40-59.3V88c0-13.3-10.7-24-24-24s-24 10.7-24 24V292.7c-23.5 9.5-40 32.5-40 59.3c0 35.3 28.7 64 64 64s64-28.7 64-64zM144 176a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm-16 80a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64zM400 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"
                            fill="white" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>

            @php
                // $brand=(auth()->guard('admin')->user()->brand==1);
                // $category=(auth()->guard('admin')->user()->category==1);
                // $product=(auth()->guard('admin')->user()->product==1);
                // $slider=(auth()->guard('admin')->user()->slider==1);
                // $coupons=(auth()->guard('admin')->user()->coupons==1);
                // $shipping=(auth()->guard('admin')->user()->shipping==1);
                // $stock=(auth()->guard('admin')->user()->stock==1);
                // $settings=(auth()->guard('admin')->user()->setting==1);
                // $orders=(auth()->guard('admin')->user()->orders==1);
                // $reports=(auth()->guard('admin')->user()->reports==1);
                // $adminuserrole=(auth()->guard('admin')->user()->adminuserrole==1);

                $brand = 1;
                $category = 1;
                $product = 1;
                $slider = 1;
                $coupons = 1;
                $shipping = 1;
                $stock = 1;
                $settings = 1;
                $orders = 1;
                $reports = 1;
                $adminuserrole = 1;
            @endphp




            <li class="{{ $route == 'brand.index' ? 'active' : '' }}">
                <a href="{{ route('brand.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Brand</span>
                </a>
            </li>

            <li class="{{ $route == 'slider.index' ? 'active' : '' }}">
                <a href="{{ route('slider.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Slider</span>
                </a>
            </li>


            @if ($category == true)
                <li class="treeview {{ $prefix == '/productcatalog' ? 'active' : '' }}">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"
                                fill="white" />
                        </svg>
                        <span>Categories</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'category.index' ? 'active' : '' }}"><a
                                href="{{ route('category.index') }}"><i class="ti-more"></i>Category</a></li>
                        <li class="{{ $route == 'subcategory.create' ? 'active' : '' }}"><a
                                href="{{ route('subcategory.create') }}"><i class="ti-more"></i>Subcategory</a></li>
                        <li class="{{ $route == 'subsubcategory.create' ? 'active' : '' }}"><a
                                href="{{ route('subsubcategory.create') }}"><i class="ti-more"></i>Sub-Subcategory</a>
                        </li>
                    </ul>
                </li>
            @endif

            <li class="treeview {{ $prefix == '/quotation' ? 'active' : '' }}">
                <a href="#">
                    <i data-feather="mail"></i> <span>Quotation Builder</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'package.index' ? 'active' : '' }}"><a
                            href="{{ route('package.index') }}"><i class="ti-more"></i>Create Quotation Package</a></li>

                    <li class="{{ $route == 'quotation.create' ? 'active' : '' }}"><a href="{{ route('quotation.create') }}"><i class="ti-more"></i>Create
                        Quotation</a></li>

                    <li class="{{ $route == 'quotation.index' ? 'active' : '' }}"><a href="{{ route('quotation.index') }}"><i class="ti-more"></i>Quotation List</a></li>
                </ul>
            </li>

            {{-- <li class="{{ $prefix == '/quotation' ? 'active' : '' }}">
                <a href="{{ route('package.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Quotation Builder</span>
                </a>
            </li> --}}




            @if ($product == true)
                <li class="treeview {{ $prefix == '/product' ? 'active' : '' }}">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                            <path
                                d="M326.3 218.8c0 20.5-16.7 37.2-37.2 37.2h-70.3v-74.4h70.3c20.5 0 37.2 16.7 37.2 37.2zM504 256c0 137-111 248-248 248S8 393 8 256 119 8 256 8s248 111 248 248zm-128.1-37.2c0-47.9-38.9-86.8-86.8-86.8H169.2v248h49.6v-74.4h70.3c47.9 0 86.8-38.9 86.8-86.8z"
                                fill="white" />
                        </svg>
                        <span>Products</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'specification.index' ? 'active' : '' }}"><a
                                href="{{ route('specification.index') }}"><i class="ti-more"></i>Specifications</a></li>
                        <li class="{{ $route == 'specification-detail.create' ? 'active' : '' }}"><a
                                href="{{ route('specification-detail.create') }}"><i class="ti-more"></i>Specification
                                Details</a></li>
                        <li class="{{ $route == 'unit.index' ? 'active' : '' }}"><a href="{{ route('unit.index') }}"><i
                                    class="ti-more"></i>Product Unit</a></li>
                        <li class="{{ $route == 'product.create' ? 'active' : '' }}"><a href="{{ route('product.create') }}"><i
                                    class="ti-more"></i>Add Product</a></li>
                        <li class="{{ $route == 'product.index' ? 'active' : '' }}"><a
                                href="{{ route('product.index') }}"><i class="ti-more"></i>Product List</a></li>
                        <li class="{{ $route == 'barcode.create' ? 'active' : '' }}"><a href="{{ route('barcode.create') }}"><i class="ti-more"></i>Print
                                Barcode</a></li>
                        {{-- <li class="{{ ($route=='add_product_qty')? 'active':'' }}"><a href="{{ route('add_product_qty') }}"><i class="ti-more"></i> Add Product Specifications</a>
      </li> --}}
                        {{-- <li class="{{ ($route=='manage-product')? 'active':'' }}"><a href="{{ route('manage-product') }}"><i class="ti-more"></i> Manage Product Specifications</a></li>
      --}}

                    </ul>
                </li>
            @endif


            <li class="{{ $route == 'coupon.index' ? 'active' : '' }}">
                <a href="{{ route('coupon.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Coupon</span>
                </a>
            </li>



            @if ($shipping == true)
                <li class="treeview {{ $prefix == '/shipping' ? 'active' : '' }}">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"
                                fill="white" />
                        </svg>
                        <span>Shipping Area</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'manage-division' ? 'active' : '' }}"><a
                                href="{{ route('manage-division') }}"><i class="ti-more"></i>Ship Division</a></li>

                        <li class="{{ $route == 'manage-district' ? 'active' : '' }}"><a
                                href="{{ route('manage-district') }}"><i class="ti-more"></i>Ship District</a></li>

                        <li class="{{ $route == 'manage-state' ? 'active' : '' }}"><a
                                href="{{ route('manage-state') }}"><i class="ti-more"></i>Ship State</a></li>
                    </ul>
                </li>
            @endif


            @if ($orders == true)
                <li class="treeview {{ $prefix == '/orders' ? 'active' : '' }}">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                            <path
                                d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20h44v44c0 11 9 20 20 20s20-9 20-20V180h44c11 0 20-9 20-20s-9-20-20-20H356V96c0-11-9-20-20-20s-20 9-20 20v44H272c-11 0-20 9-20 20z"
                                fill="white" />
                        </svg>
                        <span>Order</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'pending-orders' ? 'active' : '' }}"><a
                                href="{{ route('pending-orders') }}"><i class="ti-more"></i>Pending Order</a></li>

                        <li class="{{ $route == 'confirmed-orders' ? 'active' : '' }}"><a
                                href="{{ route('confirmed-orders') }}"><i class="ti-more"></i>Confirmed Order</a>
                        </li>

                        <li class="{{ $route == 'processing-orders' ? 'active' : '' }}"><a
                                href="{{ route('processing-orders') }}"><i class="ti-more"></i>Processing Order</a>
                        </li>

                        <li class="{{ $route == 'picked-orders' ? 'active' : '' }}"><a
                                href="{{ route('picked-orders') }}"><i class="ti-more"></i>Picked Order</a></li>

                        <li class="{{ $route == 'shipped-orders' ? 'active' : '' }}"><a
                                href="{{ route('shipped-orders') }}"><i class="ti-more"></i>Shipped Order</a></li>

                        <li class="{{ $route == 'delivered-orders' ? 'active' : '' }}"><a
                                href="{{ route('delivered-orders') }}"><i class="ti-more"></i>Delivered Order</a>
                        </li>

                        <li class="{{ $route == 'cancel-orders' ? 'active' : '' }}"><a
                                href="{{ route('cancel-orders') }}"><i class="ti-more"></i>Cancel Order</a></li>

                    </ul>
            @endif



            <li class="{{ $route == 'vendor.index' ? 'active' : '' }}">
                <a href="{{ route('vendor.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Vendor</span>
                </a>
            </li>






            <li class="treeview {{ $prefix == '/Purchase' ? 'active' : '' }}">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"
                            fill="white" />
                    </svg>
                    <span>Purchases</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'create.purchase' ? 'active' : '' }}"><a
                            href="{{ route('create.purchase') }}"><i class="ti-more"></i>Add Purchase</a></li>
                            <li class="{{ $route == 'view.purchase' ? 'active' : '' }}"><a
                                href="{{ route('view.purchase') }}"><i class="ti-more"></i>Purchase List</a></li>
                    <li class="{{ $route == 'purchase-due-collection' ? 'active' : '' }}"><a
                            href="{{ route('purchase-due-collection') }}"><i class="ti-more"></i>Due Collection</a>
                    </li>
                </ul>
            </li>


            <li class="treeview {{ $prefix == '/sale' ? 'active' : '' }}">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"
                            fill="white" />
                    </svg>
                    <span>Sales</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'create.sale' ? 'active' : '' }}"><a href="{{ route('create.sale') }}"><i
                                class="ti-more"></i>Add Sale</a></li>
                                <li class="{{ $route == 'view.sale' ? 'active' : '' }}"><a
                                    href="{{ route('view.sale') }}"><i class="ti-more"></i>Sale List</a></li>
                    <li class="{{ $route == 'sale-due-collection' ? 'active' : '' }}"><a
                            href="{{ route('sale-due-collection') }}"><i class="ti-more"></i>Due Collection</a></li>

                </ul>
            </li>


            <li class="{{ $route == 'expense.index' ? 'active' : '' }}">
                <a href="{{ route('expense.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Expense</span>
                </a>
            </li>

            <li class="treeview {{ $prefix == '/reports' ? 'active' : '' }}">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"
                            fill="white" />
                    </svg>
                    <span>Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'create.purchase-report' ? 'active' : '' }}"><a
                            href="{{ route('create.purchase-report') }}"><i class="ti-more"></i>Purchase Report</a>
                    </li>
                    <li class="{{ $route == 'create.sale-report' ? 'active' : '' }}"><a
                            href="{{ route('create.sale-report') }}"><i class="ti-more"></i>Sale Report</a></li>
                    <li class="{{ $route == 'create.inventory-report' ? 'active' : '' }}"><a
                            href="{{ route('create.inventory-report') }}"><i class="ti-more"></i>Inventory Report</a>
                    </li>
                    <li class="{{ $route == 'create.supplier-report' ? 'active' : '' }}"><a
                            href="{{ route('create.supplier-report') }}"><i class="ti-more"></i>Supplier Wise
                            Report</a></li>
                    <li class="{{ $route == 'create.customer-report' ? 'active' : '' }}"><a
                            href="{{ route('create.customer-report') }}"><i class="ti-more"></i>Customer Wise
                            Report</a></li>
                    <li class="{{ $route == 'create.expense-report' ? 'active' : '' }}"><a
                            href="{{ route('create.expense-report') }}"><i class="ti-more"></i>Expense Report</a>
                    </li>
                </ul>
            </li>


            <li class="treeview {{ $prefix == 'landing-page' ? 'active' : '' }}">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"
                            fill="white" />
                    </svg>
                    <span>Landing Page</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'menu.index' ? 'active' : '' }}"><a href="{{ route('menu.index') }}"><i
                                class="ti-more"></i>Menu</a></li>
                    <li class="{{ $route == 'submenu.create' ? 'active' : '' }}"><a
                            href="{{ route('submenu.create') }}"><i class="ti-more"></i>Submenu</a></li>
                    <li class="{{ $route == 'subsubmenu.create' ? 'active' : '' }}"><a
                            href="{{ route('subsubmenu.create') }}"><i class="ti-more"></i>Subsubmenu</a></li>
                    <li class="{{ $route == 'landing-page-slider.create' ? 'active' : '' }}"><a
                            href="{{ route('landing-page-slider.create') }}"><i class="ti-more"></i>Slider</a></li>
                    <li class="{{ $route == 'notice.index' ? 'active' : '' }}"><a href="{{ route('notice.index') }}"><i
                                class="ti-more"></i>Notice</a></li>
                    <li class="{{ $route == 'about-us.index' ? 'active' : '' }}"><a
                            href="{{ route('about-us.index') }}"><i class="ti-more"></i>About Us</a></li>
                </ul>
            </li>


            <li class="treeview {{ $prefix == 'administration' ? 'active' : '' }}">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M64 144a48 48 0 1 0 0-96 48 48 0 1 0 0 96zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM64 464a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm48-208a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z"
                            fill="white" />
                    </svg>
                    <span>Administration</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'role.index' ? 'active' : '' }}"><a href="{{ route('role.index') }}"><i
                                class="ti-more"></i>Role Permission</a></li>

                    </li>
                    <li class="{{ $route == 'user-management.index' ? 'active' : '' }}"><a
                            href="{{ route('user-management.index') }}"><i class="ti-more"></i>User Management</a>
                    </li>
                </ul>
            </li>


            <li class="{{ $route == 'site-setting.index' ? 'active' : '' }}">
                <a href="{{ route('site-setting.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Site Settings</span>
                </a>
            </li>

            <li class="{{ $route == 'seo-setting.index' ? 'active' : '' }}">
                <a href="{{ route('seo-setting.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>SEO Settings</span>
                </a>
            </li>

            <li class="{{ $route == 'social-media-setting.index' ? 'active' : '' }}">
                <a href="{{ route('social-media-setting.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Social Media Settings</span>
                </a>
            </li>

            <li class="{{ $route == 'currency.index' ? 'active' : '' }}">
                <a href="{{ route('currency.index') }}">
                    <i data-feather="message-circle"></i>
                    <span>Currency</span>
                </a>
            </li>
        </ul>
    </section>

    <div class="sidebar-footer">
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title=""
            data-original-title="Email"><i class="ti-email"></i></a>
        <!-- item-->
        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
