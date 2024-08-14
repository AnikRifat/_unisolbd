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
                                            class="d-flex justify-content-center align-items-center bg font-size-40  width-122 height-75">
                                            <img src="{{ $category->category_icon }}" alt="">
                                        </div>
                                        <div class="bg-white px-2 p-2 width-122 height-60">
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

            @include('frontend.body.new_arrival')
            @include('frontend.body.portfolio')
            <div class="row">
                <div class="col-12 col-wd-12gdot5">
                    <div class="my-2">
                        <h3 class="mb-0 pb-2 font-size-22 text-center font-weight-bold">Featured Products</h3>
                        <p class="m-0 text-center">Check & Get Your Desired Product!</p>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters mb-6">
                        @foreach ($featured as $product)
                            <li class="col-6 col-md-2gdot4 product-item">
                                @include('frontend.common.product_card')
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
