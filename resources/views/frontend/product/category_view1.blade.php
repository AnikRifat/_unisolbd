@extends('frontend.main_master')
@section('title')
    Sub Category Product
@endsection
@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                                {{ count($CategoryWiseProducts) > 0 ? $CategoryWiseProducts->first()->category->category_name : '' }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="row mb-8">
                <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                    <div class="mb-2">
                        <div class="border-bottom border-color-1 mb-2">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Filters</h3>
                        </div>
                        <div class="border-bottom pb-2 mb-2">
                            <h4 class="font-size-14 mb-3 font-weight-bold">Brands</h4>

                            @php
                                $brandCounts = $CategoryWiseProducts->groupBy('brand.brand_name')->map(fn($products) => $products->count());
                            @endphp

                            @foreach ($brandCounts as $brandName => $count)
                                @if ($loop->index < 3)
                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="brand{{ $brandName }}">
                                            <label class="custom-control-label" for="brand{{ $brandName }}">
                                                {{ $brandName }} ({{ $count }})
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    @if ($loop->index === 3)
                                        <!-- View More - Collapse -->
                                        <div class="collapse" id="collapseBrand">
                                    @endif

                                    <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="brand{{ $brandName }}">
                                            <label class="custom-control-label" for="brand{{ $brandName }}">
                                                {{ $brandName }} ({{ $count }})
                                            </label>
                                        </div>
                                    </div>

                                    @if ($loop->last)
                                        </div>
                        <!-- End View More - Collapse -->

                        <!-- Link -->
                        <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2"
                            data-toggle="collapse" href="#collapseBrand" role="button" aria-expanded="false"
                            aria-controls="collapseBrand">
                            <span class="link__icon text-gray-27 bg-white">
                                <span class="link__icon-inner">+</span>
                            </span>
                            <span class="link-collapse__default">Show more</span>
                            <span class="link-collapse__active">Show less</span>
                        </a>
                        <!-- End Link -->
                        @endif
                        @endif
                        @endforeach
                    </div>



                </div>

                {{-- @forelse ($specification as $attribute => $values)
                    <div class="border-bottom pb-2 mb-2">
                        <h4 class="font-size-14 mb-3 font-weight-bold">{{ $attribute }}</h4>
                        @foreach ($values as $value)
                            @if ($loop->index < 1)
                                <!-- Checkboxes -->
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="{{ $value }}">
                                        <label class="custom-control-label"
                                            for="{{ $value }}">{{ $value }}</label>
                                    </div>
                                </div>

                                <!-- End Checkboxes -->
                            @else
                                @if ($loop->index === 1)
                                    <!-- View More - Collapse -->
                                    <div class="collapse" id="{{ $attribute }}">
                                @endif
                                <div class="form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="{{ $value }}">
                                        <label class="custom-control-label"
                                            for="{{ $value }}">{{ $value }}</label>
                                    </div>
                                </div>
                                @if ($loop->last)
                    </div>
                    <!-- End View More - Collapse -->

                    <!-- Link -->
                    <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2" data-toggle="collapse"
                        href="#{{ $attribute }}" role="button" aria-expanded="false"
                        aria-controls="{{ $attribute }}">
                        <span class="link__icon text-gray-27 bg-white">
                            <span class="link__icon-inner">+</span>
                        </span>
                        <span class="link-collapse__default">Show more</span>
                        <span class="link-collapse__active">Show less</span>
                    </a>
                    <!-- End Link -->
                @endif
                @endif
                @endforeach
            </div>
            @endforeach --}}

                <div class="mb-8">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Latest Products</h3>
                    </div>
                    <ul class="list-unstyled">
                        @forelse ($latest_products as $product)
                            <li class="mb-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                            class="d-block width-75">
                                            <img class="img-fluid" src="{{ asset($product->product_thambnail) }}"
                                                alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a
                                                href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                        </h3>

                                        @auth
                                    <div class="font-weight-bold">
                                        {{-- <del class="font-size-11 text-gray-9 d-block">{{$product->discount_price != null ? $prouduct->selling_price  $currency->symbol:""}}</del>
                                    <ins class="font-size-15 text-red text-decoration-none d-block">{{$product->discount_price != null ? $prouduct->discount_price:$product->selling_price}}{{ $currency->symbol }}</ins> --}}
                                        <del class="font-size-11 text-gray-9 d-block">
                                            {{ $product->discount_price != null ? $product->selling_price . $currency->symbol : '' }}
                                        </del>
                                        <ins class="font-size-15 text-red text-decoration-none d-block">
                                            {{ $product->discount_price != null ? $product->discount_price : $product->selling_price }}{{ $currency->symbol }}
                                        </ins>

                                    </div>
                                    <div class="prodcut-add-cart">
                                        <a href="{{ route('login') }}"
                                            class="btn btn-primary transition-3d-hover btn-block"><i
                                                class="ec ec-login"></i>Login to see price</a>
                                    </div>
                                @endauth
                                    </div>
                                </div>
                            </li>
                        @empty
                        @endforelse

                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-wd-9gdot5">
                <!-- Shop-control-bar Title -->
                <div class="d-block d-md-flex flex-center-between mb-3">
                    <h3 class="font-size-25 mb-2 mb-md-0">
                        {{ count($CategoryWiseProducts) > 0 ? $CategoryWiseProducts->first()->category->category_name : '' }}
                    </h3>
                    <p class="font-size-14 text-gray-90 mb-0">Showing 1–25 of 56 results</p>
                </div>
                <!-- End shop-control-bar Title -->
                <!-- Shop-control-bar -->
                <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                    <div class="d-xl-none">
                        <!-- Account Sidebar Toggle Button -->
                        <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;"
                            role="button" aria-controls="sidebarContent1" aria-haspopup="true" aria-expanded="false"
                            data-unfold-event="click" data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent1" data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="500">
                            <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                        </a>
                        <!-- End Account Sidebar Toggle Button -->
                    </div>
                    <div class="px-3 d-none d-xl-block">
                        <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-one-example1-tab" data-toggle="pill"
                                    href="#pills-one-example1" role="tab" aria-controls="pills-one-example1"
                                    aria-selected="false">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-two-example1-tab" data-toggle="pill"
                                    href="#pills-two-example1" role="tab" aria-controls="pills-two-example1"
                                    aria-selected="false">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-align-justify"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-three-example1-tab" data-toggle="pill"
                                    href="#pills-three-example1" role="tab" aria-controls="pills-three-example1"
                                    aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-list"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-four-example1-tab" data-toggle="pill"
                                    href="#pills-four-example1" role="tab" aria-controls="pills-four-example1"
                                    aria-selected="true">
                                    <div class="d-md-flex justify-content-md-center align-items-md-center">
                                        <i class="fa fa-th-list"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex">
                        <form method="get">
                            <!-- Select -->
                            <select
                                class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"
                                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option value="one" selected>Default sorting</option>
                                <option value="two">Sort by popularity</option>
                                <option value="three">Sort by average rating</option>
                                <option value="four">Sort by latest</option>
                                <option value="five">Sort by price: low to high</option>
                                <option value="six">Sort by price: high to low</option>
                            </select>
                            <!-- End Select -->
                        </form>
                        <form method="POST" class="ml-2 d-none d-xl-block">
                            <!-- Select -->
                            <select class="js-select selectpicker dropdown-select max-width-120"
                                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option value="one" selected>Show 20</option>
                                <option value="two">Show 40</option>
                                <option value="three">Show All</option>
                            </select>
                            <!-- End Select -->
                        </form>
                    </div>
                    <nav class="px-3 flex-horizontal-center text-gray-20 d-none d-xl-flex">
                        <form method="post" class="min-width-50 mr-1">
                            <input size="2" min="1" max="3" step="1" type="number"
                                class="form-control text-center px-2 height-35" value="1">
                        </form> of 3
                        <a class="text-gray-30 font-size-20 ml-2" href="#">→</a>
                    </nav>
                </div>
                <!-- End Shop-control-bar -->
                <!-- Shop Body -->
                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel"
                        aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters">

                            @foreach ($CategoryWiseProducts as $product)
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-4 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="{{ url('category/product/' . $product['category']['id'] . '/' . $product['category']['category_slug']) }}"
                                                        class="font-size-12 text-gray-5">
                                                        {{ $product['category']['category_name'] }}</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                        class="text-blue font-weight-bold">{{ $product->product_name }}</a>
                                                </h5>
                                                <div class="mb-2">
                                                    <a href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset($product->product_thambnail) }}"
                                                            alt="Image Description"></a>
                                                </div>
                                                <div class="flex-center-between mb-1">
                                                    <div
                                                        class="prodcut-price d-flex align-items-center flex-wrap position-relative mt-2">
                                                        @if ($product->discount_price != null)
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->discount_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                            <del
                                                                class="font-size-15 tex-gray-6 position-absolute bottom-100">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</del>
                                                        @else
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @endif
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="  {{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                    <div class="tab-pane fade pt-2" id="pills-two-example1" role="tabpanel"
                        aria-labelledby="pills-two-example1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters">
                            @foreach ($CategoryWiseProducts as $product)
                                <li class="col-6 col-md-3 col-wd-2gdot4 product-item">
                                    <div class="product-item__outer h-100">
                                        <div class="product-item__inner px-xl-4 p-3">
                                            <div class="product-item__body pb-xl-2">
                                                <div class="mb-2"><a
                                                        href="{{ url('category/product/' . $product['category']['id'] . '/' . $product['category']['category_slug']) }}"
                                                        class="font-size-12 text-gray-5">
                                                        {{ $product['category']['category_name'] }}</a></div>
                                                <h5 class="mb-1 product-item__title"><a
                                                        href="  {{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                        class="text-blue font-weight-bold">{{ $product->product_name }}</a>
                                                </h5>
                                                <div class="mb-2">
                                                    <a href="  {{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset($product->product_thambnail) }}"
                                                            alt="Image Description"></a>
                                                </div>


                                                <div class="text-gray-20 mb-2 font-size-12">SKU:
                                                    {{ $product->product_code }}</div>
                                                <div class="flex-center-between mb-1">
                                                    <div class="prodcut-price">
                                                        @if ($product->discount_price != null)
                                                            <del
                                                                class="font-size-15 tex-gray-6">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</del>
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->discount_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @else
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @endif
                                                    </div>
                                                    <div class="d-none d-xl-block prodcut-add-cart">
                                                        <a href="  {{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="tab-pane fade pt-2" id="pills-three-example1" role="tabpanel"
                        aria-labelledby="pills-three-example1-tab" data-target-group="groups">
                        <ul class="d-block list-unstyled products-group prodcut-list-view">
                            @foreach ($CategoryWiseProducts as $product)
                                <li class="product-item remove-divider">
                                    <div class="product-item__outer w-100">
                                        <div class="product-item__inner remove-prodcut-hover py-4 row">
                                            <div class="product-item__header col-6 col-md-4">
                                                <div class="mb-2">
                                                    <a href="  {{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset($product->product_thambnail) }}"
                                                            alt="Image Description"></a>
                                                </div>
                                            </div>
                                            <div class="product-item__body col-6 col-md-5">
                                                <div class="pr-lg-10">
                                                    <div class="mb-2"><a
                                                            href="{{ url('category/product/' . $product['category']['id'] . '/' . $product['category']['category_slug']) }}"
                                                            class="font-size-12 text-gray-5">
                                                            {{ $product['category']['category_name'] }}</a></div>
                                                    <h5 class="mb-2 product-item__title"><a
                                                            href="  {{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                            class="text-blue font-weight-bold">{{ $product->product_name }}</a>
                                                    </h5>
                                                    <div class="prodcut-price mb-2 d-md-none">
                                                        @if ($product->discount_price != null)
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->discount_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                            <del
                                                                class="font-size-15 tex-gray-6 position-absolute bottom-100">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</del>
                                                        @else
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="product-item__footer col-md-3 d-md-block">
                                                <div class="mb-3">
                                                    <div class="prodcut-price mb-2">
                                                        @if ($product->discount_price != null)
                                                            <del
                                                                class="font-size-15 tex-gray-6">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</del>
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->discount_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @else
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @endif
                                                    </div>
                                                    <div class="prodcut-add-cart">
                                                        <a href="javascript:void(0)" onclick="addToCart(this)"
                                                            data-product-id="{{ $product->id }}"
                                                            class="btn btn-sm btn-block btn-primary-dark btn-wide transition-3d-hover">Add
                                                            to cart</a>
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap">
                                                    <a href="../shop/compare.html"
                                                        class="text-gray-6 font-size-13 mx-wd-3"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html"
                                                        class="text-gray-6 font-size-13 mx-wd-3"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade pt-2" id="pills-four-example1" role="tabpanel"
                        aria-labelledby="pills-four-example1-tab" data-target-group="groups">
                        <ul class="d-block list-unstyled products-group prodcut-list-view-small">
                            @foreach ($CategoryWiseProducts as $product)
                                <li class="product-item remove-divider">
                                    <div class="product-item__outer w-100">
                                        <div class="product-item__inner remove-prodcut-hover py-4 row">
                                            <div class="product-item__header col-6 col-md-2">
                                                <div class="mb-2">
                                                    <a href="  {{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                        class="d-block text-center"><img class="img-fluid"
                                                            src="{{ asset($product->product_thambnail) }}"
                                                            alt="Image Description"></a>
                                                </div>
                                            </div>
                                            <div class="product-item__body col-6 col-md-7">
                                                <div class="pr-lg-10">
                                                    <div class="mb-2"><a
                                                            href="{{ url('category/product/' . $product['category']['id'] . '/' . $product['category']['category_slug']) }}"
                                                            class="font-size-12 text-gray-5">
                                                            {{ $product['category']['category_name'] }}</a></div>
                                                    <h5 class="mb-2 product-item__title"><a
                                                            href="  {{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                            class="text-blue font-weight-bold">{{ $product->product_name }}</a>
                                                    </h5>
                                                    <div class="prodcut-price d-md-none">
                                                        @if ($product->discount_price != null)
                                                            <del
                                                                class="font-size-15 tex-gray-6">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</del>
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->discount_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @else
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-item__footer col-md-3 d-md-block">
                                                <div class="mb-2 flex-center-between">
                                                    <div class="prodcut-price">
                                                        @if ($product->discount_price != null)
                                                            <del
                                                                class="font-size-15 tex-gray-6">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</del>
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->discount_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @else
                                                            <ins
                                                                class="font-size-20 text-red text-decoration-none mr-2">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @endif
                                                    </div>
                                                    <div class="prodcut-add-cart">
                                                        <a href="../shop/single-product-fullwidth.html"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                                <div
                                                    class="flex-horizontal-center justify-content-between justify-content-wd-center flex-wrap border-top pt-3">
                                                    <a href="../shop/compare.html"
                                                        class="text-gray-6 font-size-13 mx-wd-3"><i
                                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                    <a href="../shop/wishlist.html"
                                                        class="text-gray-6 font-size-13 mx-wd-3"><i
                                                            class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- End Tab Content -->
                <!-- End Shop Body -->
                <!-- Shop Pagination -->
                <nav class="d-md-flex justify-content-between align-items-center border-top pt-3"
                    aria-label="Page navigation example">
                    <div class="text-center text-md-left mb-3 mb-md-0">Showing 1–25 of 56 results</div>
                    <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start">
                        <li class="page-item"><a class="page-link current" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                    </ul>
                </nav>
                <!-- End Shop Pagination -->
            </div>
        </div>
        <!-- Brand Carousel -->
        @include('frontend.body.brands')
        <!-- End Brand Carousel -->
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
