@extends('frontend.main_master')
@section('title')
    Home Page
@endsection
@section('content')
    <main id="content" role="main">

        <!-- Slider Section -->
        @include('frontend.common.slider')
        <!-- End Slider Section -->


        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h3 class="mb-0 pb-2 font-size-22 text-center font-weight-bold">Categories</h3>
                        <p class="m-0 text-center">Get Your Desired Product from Category!</p>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters mb-6 justify-content-center">
                        @foreach ($categories as $category)
                            <li class="product-item mr-2">
                                <div class="js-slide">
                                    <a href="{{ url('category/product/' . $category->category_slug . '/' . encrypt($category->id)) }}"
                                        class="d-block text-center bg-on-hover width-122 mx-auto">
                                        <div
                                            class="d-flex justify-content-center align-items-center bg font-size-40 pt-4 rounded-circle-top width-122 height-75">
                                            <img src="{{ $category->category_icon }}" alt="">
                                        </div>
                                        <div class="bg-white px-2 pt-2 width-122">
                                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">
                                                {{ $category->category_name }}</h6>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <style>
                html,
                body {
                  position: relative;
                  height: 100%;
                }

                body {
                  background: #eee;
                  font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
                  font-size: 14px;
                  color: #000;
                  margin: 0;
                  padding: 0;
                }

                .swiper {
                  width: 100%;
                  height: 100%;
                  margin-left: auto;
                  margin-right: auto;
                }

                .swiper-slide {
                  text-align: center;
                  font-size: 18px;
                  background: #fff;
                  height: calc((70% - 30px) / 2) !important;

                  /* Center slide text vertically */
                  display: flex;
                  justify-content: center;
                  align-items: center;
                }
              </style>
 <div class="row row no-gutters">
    <div class="col-md-12">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($new_arrival as $item)

                <div class="swiper-slide">

                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ url('/product/details/' . $item->product_slug . '/' . encrypt($item->id)) }}"
                                class="d-block text-center"><img style="height: 100px" class="img-fluid"
                                    src="{{ asset($item->product_thambnail) }}"
                                    alt="Image Description"></a>
                        </div>
                        <div class="col-md-8">
                            <p>
                                {{$item->product_name}}
                            </p>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
          </div>
    </div>
 </div>
 @include('frontend.body.portfolio')
            <div class="row">
                <div class="col-12 col-wd-12gdot5">
                    <div class="mb-2">
                        <h3 class="mb-0 pb-2 font-size-22 text-center font-weight-bold">Featured Products</h3>
                        <p class="m-0 text-center">Check & Get Your Desired Product!</p>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters mb-6">
                        @foreach ($featured as $product)
                            <li class="col-6 col-md-2gdot4 product-item">
                                <div class="product-item__outer h-100">
                                    <div class="product-item__inner px-xl-4 p-3">
                                        <div class="product-item__body pb-xl-2">

                                            <div class="mb-2">
                                                @if ($product->subsubcategory_id != null)
                                                    <a href="{{ url('subsubcategory/product/' . $product->subsubcategory->subsubcategory_slug . '/' . encrypt($product->subsubcategory_id)) }}"
                                                        class="font-size-12 text-gray-5">{{ $product->subsubcategory->subsubcategory_name }}</a>
                                                @elseif ($product->subcategory_id != null)
                                                    <a href="{{ url('subcategory/product/' . $product->subcategory->subcategory_slug . '/' . encrypt($product->subcategory_id)) }}"
                                                        class="font-size-12 text-gray-5">{{ $product->subcategory->subcategory_name }}</a>
                                                @else
                                                    <a href="{{ url('category/product/' . $product->category->category_slug . '/' . encrypt($product->category_id)) }}"
                                                        class="font-size-12 text-gray-5">{{ $product->category->category_name }}</a>
                                                @endif
                                            </div>

                                            <h5 class="mb-1 product-item__title"><a
                                                    href="{{ url('/product/details/' . $product->product_slug . '/' . encrypt($product->id)) }}"
                                                    class="text-blue font-weight-bold" data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="{{ $product->product_name }}">{{ $product->product_name }}</a>
                                            </h5>
                                            <div class="mb-2">
                                                <a href="{{ url('/product/details/' . $product->product_slug . '/' . encrypt($product->id)) }}"
                                                    class="d-block text-center"><img class="img-fluid"
                                                        src="{{ asset($product->product_thambnail) }}"
                                                        alt="Image Description"></a>
                                            </div>
                                            @auth
                                                <div class="flex-center-between mb-1">
                                                    <div
                                                        class="prodcut-price d-flex align-items-center flex-wrap position-relative">


                                                        @if ($product->discount_price != null)
                                                            <ins class="font-size-20 text-red text-decoration-none mr-2">
                                                                {{ number_format($product->discount_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                            <del
                                                                class="font-size-12 tex-gray-6 position-absolute bottom-100">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</del>
                                                        @else
                                                            <ins class="font-size-20 text-red text-decoration-none mr-2">
                                                                {{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                                        @endif

                                                    </div>
                                                    <div class="prodcut-add-cart">
                                                        <a href="javascript:void(0)" onclick="addToCart(this)"
                                                            data-product-id="{{ base64_encode($product->id) }}"
                                                            class="btn-add-cart btn-primary transition-3d-hover"><i
                                                                class="ec ec-add-to-cart"></i></a>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="prodcut-add-cart">
                                                    <a href="{{ route('login') }}"
                                                        class="btn btn-primary transition-3d-hover btn-block"><i
                                                            class="ec ec-login"></i>Login to see price</a>
                                                </div>
                                            @endauth


                                        </div>
                                        <div class="product-item__footer">
                                            <div class="border-top pt-2 flex-center-between flex-wrap">
                                                <a href="javascript:void(0)" class="text-gray-6 font-size-13"><i
                                                        class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                                <a href="javascript:void(0)"
                                                    onclick="addWishlist(this)"data-product="{{ base64_encode($product->id) }}"
                                                    class="text-gray-6 font-size-13"><i
                                                        class="ec ec-favorites mr-1 font-size-15"></i>Wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>








        </div>
    </main>

    <script>
        $(document).ready(function() {
            $("#basicsCollapseOne").addClass('show');
        });
    </script>
@endsection
