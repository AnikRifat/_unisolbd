<li class="treeview ">
    <a href="#">
        <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
            <path
                d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM252 160c0 11 9 20 20 20h44v44c0 11 9 20 20 20s20-9 20-20V180h44c11 0 20-9 20-20s-9-20-20-20H356V96c0-11-9-20-20-20s-20 9-20 20v44H272c-11 0-20 9-20 20z"
                fill="white" />
        </svg>
        <span>User Management</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ $route == 'user-management.index' ? 'active' : '' }}"><a
                href="{{ route('user-management.index') }}"><i class="ti-more"></i>All Users</a></li>

        <li class="{{ $route == 'customer-groups.index' ? 'active' : '' }}"><a
                href="{{ route('customer-groups.index') }}"><i class="ti-more"></i>User Group</a>
        </li>



    </ul>
</li>
<li class="{{ $route == 'solution.index' ? 'active' : '' }}"><a href="{{ route('solution.index') }}"><i
            class="ti-more"></i>solution</a>
</li>
<li class="{{ request()->is('brand*') ? 'active' : '' }}">
    <a href="{{ url('/') }}/brand">
        <i data-feather="flag"></i>
        <span>Brand</span>
    </a>
</li>
<li class="{{ request()->is('slider*') ? 'active' : '' }}">
    <a href="{{ url('/') }}/slider">
        <i data-feather="sliders"></i>
        <span>Slider</span>
    </a>
</li>
<li class="treeview {{ request()->is('productcatalog*') ? 'active' : '' }}">
    <a href="#">
        <i data-feather="list"></i>
        <span>Categories</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ request()->is('productcatalog/category') ? 'active' : '' }}">
            <a href="{{ url('/') }}/productcatalog/category">
                <i class="ti-more"></i>Category
            </a>
        </li>
        <li class="{{ request()->is('productcatalog/subcategory/create') ? 'active' : '' }}">
            <a href="{{ url('/') }}/productcatalog/subcategory/create">
                <i class="ti-more"></i>Subcategory
            </a>
        </li>
        <li class="{{ request()->is('productcatalog/subsubcategory/create') ? 'active' : '' }}">
            <a href="{{ url('/') }}/productcatalog/subsubcategory/create">
                <i class="ti-more"></i>Subsubcategory
            </a>
        </li>
    </ul>
</li>
<li class="treeview {{ request()->is('dealflow*') ? 'active' : '' }}">
    <a href="#">
        <i data-feather="save"></i>
        <span>Quotation Builder</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ request()->is('dealflow/package') ? 'active' : '' }}">
            <a href="{{ url('/') }}/dealflow/package">
                <i class="ti-more"></i>Create Quotation Package
            </a>
        </li>
        <li class="{{ request()->is('dealflow/quotation/create') ? 'active' : '' }}">
            <a href="{{ url('/') }}/dealflow/quotation/create">
                <i class="ti-more"></i>Create Quotation
            </a>
        </li>
        <li class="{{ request()->is('dealflow/quotation') ? 'active' : '' }}">
            <a href="{{ url('/') }}/dealflow/quotation">
                <i class="ti-more"></i>Quotation List
            </a>
        </li>
    </ul>
</li>



<li class="treeview  "><a href="#"><i data-feather="box"></i><span>Product</span><span
            class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ url('/') }}/product/specification"><i class="ti-more"></i>Specification</a>
        </li>
        <li class=""><a href="{{ url('/') }}/product/specification-detail/create"><i
                    class="ti-more"></i>Specification Details</a></li>
        <li class=""><a href="{{ url('/') }}/product/unit"><i class="ti-more"></i>Product Unit</a></li>
        <li class=""><a href="{{ url('/') }}/product/product/create"><i class="ti-more"></i>Add
                Product</a></li>
        <li class=""><a href="{{ url('/') }}/product/product"><i class="ti-more"></i>Product List</a>
        </li>
        <li class=""><a href="{{ url('/') }}/product/barcode/create"><i class="ti-more"></i>Print
                Barcode</a></li>
    </ul>
</li>


{{-- <li class="treeview  "><a href="#"><i data-feather="map-pin"></i><span>Shipping Area</span><span
            class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ url('/') }}/shipping/division/view"><i
                    class="ti-more"></i>Division</a></li>
        <li class=""><a href="{{ url('/') }}/shipping/district/view"><i
                    class="ti-more"></i>District</a></li>
        <li class=""><a href="{{ url('/') }}/shipping/state/view"><i class="ti-more"></i>State</a></li>
    </ul>
</li>
<li class="  "><a href="{{ url('/') }}/coupon"><i data-feather="gift"></i><span>Coupon</span></a></li>
<li class="treeview  "><a href="#"><i data-feather="shopping-cart"></i><span>Order</span><span
            class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ url('/') }}/orders/pending/orders"><i class="ti-more"></i>Pending
                Order</a></li>
        <li class=""><a href="{{ url('/') }}/orders/confirmed/orders"><i class="ti-more"></i>Confirmed
                Order</a></li>
        <li class=""><a href="{{ url('/') }}/orders/processing/orders"><i
                    class="ti-more"></i>Processing Order</a></li>
        <li class=""><a href="{{ url('/') }}/orders/picked/orders"><i class="ti-more"></i>Picked
                Order</a></li>
        <li class=""><a href="{{ url('/') }}/orders/shipped/orders"><i class="ti-more"></i>Shipped
                Order</a></li>
        <li class=""><a href="{{ url('/') }}/orders/delivered/orders"><i
                    class="ti-more"></i>Delivered Order</a></li>
        <li class=""><a href="{{ url('/') }}/orders/cancel/orders"><i class="ti-more"></i>Cancel
                Order</a></li>
    </ul>
</li>
 --}}
<li class="  "><a href="{{ url('/') }}/vendor"><i data-feather="sliders"></i><span>Vendor</span></a>
</li>
<li class="treeview  "><a href="#"><i data-feather="shopping-bag"></i><span>Purchase</span><span
            class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ url('/') }}/purchase/create/purchase"><i class="ti-more"></i>Add
                Purchase</a></li>
        <li class=""><a href="{{ url('/') }}/purchase/view/purchase"><i class="ti-more"></i>Purchase
                List</a></li>
        <li class=""><a href="{{ url('/') }}/purchase/purchase/due/payment"><i class="ti-more"></i>Due
                Collection</a></li>
    </ul>
</li>
<li class="treeview  "><a href="#"><i data-feather="shopping-cart"></i><span>Sale</span><span
            class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ url('/') }}/sale/create/sale"><i class="ti-more"></i>Add Sale</a>
        </li>
        <li class=""><a href="{{ url('/') }}/sale/view/sales"><i class="ti-more"></i>Sale List</a>
        </li>
        <li class=""><a href="{{ url('/') }}/sale/sale/due/payment"><i class="ti-more"></i>Due
                Collection</a></li>
    </ul>
</li>
<li class="  "><a href="{{ url('/') }}/expense"><i data-feather="file-text"></i><span>Expense</span></a>
</li>
<li class="treeview  "><a href="#"><i data-feather="pie-chart"></i><span>Report</span><span
            class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ url('/') }}/reports/create/purchases"><i class="ti-more"></i>Purchase
                Report</a></li>
        <li class=""><a href="{{ url('/') }}/reports/create/sales"><i class="ti-more"></i>Sale
                Report</a></li>
        <li class=""><a href="{{ url('/') }}/reports/create/inventory"><i class="ti-more"></i>Inventory
                Report</a></li>
        <li class=""><a href="{{ url('/') }}/reports/create/supplier"><i class="ti-more"></i>Supplier
                Wise Report</a></li>
        <li class=""><a href="{{ url('/') }}/reports/create/customer"><i class="ti-more"></i>Cutomer
                Wise Report</a></li>
        <li class=""><a href="{{ url('/') }}/reports/create/expense"><i class="ti-more"></i>Expense
                Report</a></li>
    </ul>
</li>
<li class="treeview  "><a href="#"><i data-feather="users"></i><span>Administration</span><span
            class="pull-right-container"><i class="fa fa-angle-right pull-right"></i></span></a>
    <ul class="treeview-menu">
        <li class=""><a href="{{ url('/') }}/administration/role"><i class="ti-more"></i>Role
                Permission</a></li>
    </ul>
</li>
<li class="  "><a href="{{ url('/') }}/site-setting"><i data-feather="settings"></i><span>Site</span></a>
</li>
<li class="  "><a href="{{ url('/') }}/seo-setting"><i data-feather="globe"></i><span>Seo</span></a>
</li>
<li class="  "><a href="{{ url('/') }}/currency"><i
            data-feather="dollar-sign"></i><span>Currency</span></a></li>
<li class="  "><a href="{{ url('/') }}/social-media-setting"><i data-feather="send"></i><span>Social
            Media</span></a></li>
{{-- <li class="  active"><a href="{{ url('/') }}/landing-page/menu"><i
            data-feather="menu"></i><span>Menu</span></a></li>
<li class="  "><a href="{{ url('/') }}/landing-page/submenu/create"><i
            data-feather="link"></i><span>Submenu</span></a></li>
<li class="  "><a href="{{ url('/') }}/landing-page/subsubmenu/create"><i
            data-feather="link-2"></i><span>Subsubmenu</span></a></li> --}}

<li class="  "><a href="{{ url('/') }}/landing-page/notice"><i
            data-feather="bell"></i><span>Notice</span></a></li>
<li class="  "><a href="{{ url('/') }}/landing-page/about-us"><i data-feather="info"></i><span>About
            Us</span></a></li>
