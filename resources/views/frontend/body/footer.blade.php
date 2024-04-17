@php
    // $featured = App\Models\Product::where('featured', 1)
    //     ->inRandomOrder()
    //     ->get();
    // //$on_sale=null;
    // $on_sale = App\Models\Product::where('on_sale', 1)
    //     ->inRandomOrder()
    //     ->get();
    // $top_rated = App\Models\Product::where('top_rated', 1)
    //     ->inRandomOrder()
    //     ->get();
    // $setting = App\Models\SiteSetting::limit(1)
    //     ->get()
    //     ->first();
    $social_media = App\Models\SocialMediaSetting::where('status', 1)->get();
    // $currency = App\Models\Currency::limit(1)
    //     ->get()
    //     ->first();
@endphp

<style>
    .gradient-text {
        font-size: 72px;
  background: -webkit-linear-gradient(318deg, rgba(82,195,255,1) 36%, rgba(88,104,162,1) 75%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
</style>

<footer>
    {{-- @if (count($featured) || isset($on_sale) || isset($top_rated)) --}}
    <!-- Footer-top-widget -->
    {{-- <div id="footer-top-widget" class=" container d-none d-lg-block mb-3">
        <div class="row">
            @if (count($featured) > 0)
                <div class="col-wd-4 col-lg-4">
                   <!-- Wrapper Latest Products -->
                   <div class="mb-2 position-relative">
                    <dv class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                        <h3 class="section-title section-title__sm mb-0 pb-3 font-size-18">Featured</h3>
                    </dv>
                    <div class="js-slick-carousel u-slick u-slick--gutters-2 overflow-hidden u-slick-overflow-visble pt-3 position-static"
                        data-slides-show="1"
                        data-slides-scroll="1"
                        data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                        data-arrow-left-classes="fa fa-angle-left right-1"
                        data-arrow-right-classes="fa fa-angle-right right-0">
                        @php
                            $count=0;
                        @endphp
                        @foreach ($featured as $product)
                        @if ($count % 3 == 0)
                        <div class="js-slide">
                            <ul class="list-unstyled products-group mb-0 overflow-visible">
                        @endif
                        <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                            <div class="col-auto">
                                <a href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                    class="d-block width-75 text-center"><img class="img-fluid"
                                        src="{{ asset($product->product_thambnail) }}" alt="Image Description"></a>
                            </div>
                            <div class="col pl-4 d-flex flex-column">
                                <h5 class="product-item__title mb-0"><a
                                        href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                        class="text-blue font-weight-bold">{{ $product->product_name }}</a></h5>
                                <div class="prodcut-price mt-auto flex-horizontal-center">
                                    @if ($product->discount_price != null)
                                        <ins
                                            class="font-size-15 text-decoration-none">{{ number_format($product->discount_price, 0, '.', ',') }}{{$currency->symbol}}</ins>
                                        <del
                                            class="font-size-12 text-gray-9 ml-2">{{ number_format($product->selling_price, 0, '.', ',') }}{{$currency->symbol}}</del>
                                    @else
                                        <ins
                                            class="font-size-15 text-decoration-none">{{ number_format($product->selling_price, 0, '.', ',') }}{{$currency->symbol}}</ins>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @php
                            $count++
                        @endphp

                        @if ($count % 3 == 0 || $count == count($featured))
                            </ul>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <!-- End Wrapper Latest Products -->
                </div>
            @endif


            @if (count($on_sale) > 0)
                <div class="col-wd-4 col-lg-4">
                    <!-- Wrapper Latest Products -->
                   <div class="mb-2 position-relative">
                    <dv class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                        <h3 class="section-title section-title__sm mb-0 pb-3 font-size-18">On Sale</h3>
                    </dv>
                    <div class="js-slick-carousel u-slick u-slick--gutters-2 overflow-hidden u-slick-overflow-visble pt-3 position-static"
                        data-slides-show="1"
                        data-slides-scroll="1"
                        data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                        data-arrow-left-classes="fa fa-angle-left right-1"
                        data-arrow-right-classes="fa fa-angle-right right-0">
                        @php
                            $count=0;
                        @endphp
                        @foreach ($on_sale as $product)
                        @if ($count % 3 == 0)
                        <div class="js-slide">
                            <ul class="list-unstyled products-group mb-0 overflow-visible">
                        @endif
                        <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                            <div class="col-auto">
                                <a href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                    class="d-block width-75 text-center"><img class="img-fluid"
                                        src="{{ asset($product->product_thambnail) }}" alt="Image Description"></a>
                            </div>
                            <div class="col pl-4 d-flex flex-column">
                                <h5 class="product-item__title mb-0"><a
                                        href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                        class="text-blue font-weight-bold">{{ $product->product_name }}</a></h5>
                                <div class="prodcut-price mt-auto flex-horizontal-center">
                                    @if ($product->discount_price != null)
                                        <ins
                                            class="font-size-15 text-decoration-none">{{ $currency->symbol }}{{ $product->discount_price }}</ins>
                                        <del
                                            class="font-size-12 text-gray-9 ml-2">{{ $currency->symbol }}{{ $product->selling_price }}</del>
                                    @else
                                        <ins
                                            class="font-size-15 text-decoration-none">{{ number_format($product->selling_price, 0, '.', ',') }}{{$currency->symbol}}</ins>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @php
                            $count++
                        @endphp

                        @if ($count % 3 == 0 || $count == count($on_sale))
                            </ul>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <!-- End Wrapper Latest Products -->
                </div>
            @endif

            @if (count($top_rated) > 0)
                <div class="col-wd-4 col-lg-4">
                     <!-- Wrapper Latest Products -->
                   <div class="mb-2 position-relative">
                    <dv class="d-flex justify-content-between border-bottom border-color-1 flex-md-nowrap flex-wrap border-sm-bottom-0">
                        <h3 class="section-title section-title__sm mb-0 pb-3 font-size-18">Top Rated</h3>
                    </dv>
                    <div class="js-slick-carousel u-slick u-slick--gutters-2 overflow-hidden u-slick-overflow-visble pt-3 position-static"
                        data-slides-show="1"
                        data-slides-scroll="1"
                        data-arrows-classes="position-absolute top-0 font-size-17 u-slick__arrow-normal top-10"
                        data-arrow-left-classes="fa fa-angle-left right-1"
                        data-arrow-right-classes="fa fa-angle-right right-0">
                        @php
                            $count=0;
                        @endphp
                        @foreach ($top_rated as $product)
                        @if ($count % 3 == 0)
                        <div class="js-slide">
                            <ul class="list-unstyled products-group mb-0 overflow-visible">
                        @endif
                        <li class="product-item product-item__list row no-gutters mb-6 remove-divider">
                            <div class="col-auto">
                                <a href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                    class="d-block width-75 text-center"><img class="img-fluid"
                                        src="{{ asset($product->product_thambnail) }}" alt="Image Description"></a>
                            </div>
                            <div class="col pl-4 d-flex flex-column">
                                <h5 class="product-item__title mb-0"><a
                                        href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                        class="text-blue font-weight-bold">{{ $product->product_name }}</a></h5>
                                <div class="prodcut-price mt-auto flex-horizontal-center">
                                    @if ($product->discount_price != null)
                                        <ins
                                            class="font-size-15 text-decoration-none">{{ number_format($product->discount_price, 0, '.', ',') }}{{$currency->symbol}}</ins>
                                        <del
                                            class="font-size-12 text-gray-9 ml-2">{{ number_format($product->selling_price, 0, '.', ',') }}{{$currency->symbol}}</del>
                                    @else
                                        <ins
                                            class="font-size-15 text-decoration-none">{{ number_format($product->selling_price, 0, '.', ',') }}{{$currency->symbol}}</ins>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @php
                            $count++
                        @endphp

                        @if ($count % 3 == 0 || $count == count($top_rated))
                            </ul>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <!-- End Wrapper Latest Products -->
                </div>
            @endif
        </div>
    </div> --}}
    <!-- End Footer-top-widget -->
    {{-- @endif --}}



    <!-- Footer-bottom-widgets -->
    <div class="pt-4 pb-4 bg-soft-dark">
        <div class="container mt-1">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <a  href="#" class="t3solutionlogo d-inline-block">
                            <img  src="{{asset($setting->logo)  }}" alt="">
                        </a>
                    </div>
                    <div class="mb-1">
                        <div class="row no-gutters">
                            <div class="col-auto">
                                <i class="ec ec-support gradient-text font-size-56"></i>
                            </div>
                            <div class="col pl-3">
                                <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                                <a href="tel:+80080018588" class="font-size-20 text-gray-90">{{ $setting->phone_one }},
                                </a><a href="tel:+0600874548"
                                    class="font-size-20 text-gray-90">{{ $setting->phone_two }}</a>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-lg-4 ">
                    <div class="row d-flex justify-content-lg-center pl-3 pl-sm-0">
                        <div>
                            <h6 class="mb-1 font-weight-bold">Customer Care</h6>
                            <!-- List Group -->
                            <ul class="list-group list-group-flush list-group-borderless mb-0 list-group-transparent">
                                <li><a class="list-group-item list-group-item-action"
                                        href="{{ route('contact_us') }}">Contact Us</a></li>
                                <li><a class="list-group-item list-group-item-action"
                                        href="{{ route('about_us') }}">About Us</a></li>
                                <li><a class="list-group-item list-group-item-action" href="{{ route('faqs') }}">FAQs</a>
                                </li>
                                <li><a class="list-group-item list-group-item-action" href="{{ route('terms_condition') }}">Terms &
                                        Conditions</a></li>
                            </ul>
                            <!-- End List Group -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row d-flex justify-content-lg-center pl-3 pl-sm-0">
                        <div>
                            <div>
                                <h6 class="mb-1 font-weight-bold">Contact info</h6>
                                <address class="mb-1">
                                    {{ $setting->company_address }}
                                </address>
                            </div>
                            <div class="mb-1 ">
                                <h6 class="mb-1 font-weight-bold">Email</h6>
                                <address class="">
                                    {{ $setting->email }}
                                </address>
                            </div>
                            <div class="my-2 my-md-4">
                                <ul class="list-inline mb-0 opacity-7">

                                    @foreach ($social_media as $media)
                                        <li class="list-inline-item mr-0">
                                            <a href="{{ $media->link }}" target="blank">
                                                <img src="{{ asset($media->icon) }}" alt="" style="height: 48px;width:48px">
                                            </a>
                                        </li>
                                    @endforeach




                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-bottom-widgets -->
    <!-- Footer-copy-right -->
    {{-- <div class="bg-gray-14 py-2">
      <div class="container">
          <div class="flex-center-between d-block d-md-flex">
              <div class="mb-3 mb-md-0">© <a href="#" class="font-weight-bold text-gray-90">{{ $setting->copyright }}</a> - All rights Reserved</div>
              <div class="text-md-right">
                  <span class="d-inline-block bg-white border rounded p-1">
                      <img class="max-width-5" src="../../assets/img/100X60/img1.jpg" alt="Image Description">
                  </span>
                  <span class="d-inline-block bg-white border rounded p-1">
                      <img class="max-width-5" src="../../assets/img/100X60/img2.jpg" alt="Image Description">
                  </span>
                  <span class="d-inline-block bg-white border rounded p-1">
                      <img class="max-width-5" src="../../assets/img/100X60/img3.jpg" alt="Image Description">
                  </span>
                  <span class="d-inline-block bg-white border rounded p-1">
                      <img class="max-width-5" src="../../assets/img/100X60/img4.jpg" alt="Image Description">
                  </span>
                  <span class="d-inline-block bg-white border rounded p-1">
                      <img class="max-width-5" src="../../assets/img/100X60/img5.jpg" alt="Image Description">
                  </span>
              </div>
          </div>
      </div>
  </div> --}}
    <!-- End Footer-copy-right -->
    <!-- Footer-newsletter -->
    <div class="py-3" style="background:  rgba(88,104,162,1)">
        <div class="container">
            <div class="row justify-content-md-between">
                <div class="col-md-3 mb-3 mb-md-0 text-center  text-white-70">Copyright © {{ now()->year }} -  <a href="http://anikrifat.xyz/" target="_blank"
                    class="font-weight-bold text-white-70">{{ $setting->copyright }}</a>
                </div>
                <div class="col-md-3 mb-3 text-center mb-md-0 text-white-70 ">Developed By : <a href="http://anikrifat.xyz/" target="_blank"
                    class="font-weight-bold text-white-70">theCodeGiant</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer-newsletter -->
</footer>
