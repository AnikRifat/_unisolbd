@php
$sliders=App\Models\Slider::where('status',1)->where('type',1)->orderBy('id','DESC')->get();
//$sliders=null;
@endphp


@if (count($sliders))
 <!-- Slider Section -->
 <div class="mb-8">
    <div class="container">
        <div class="overflow-hidden">
            <div class="bg-img-hero min-height-420" style="background-image: url(frontendassets/img/1400X420/img1.jpg);">
                <div id="thumbProgress" class="js-slick-carousel u-slick"
                    data-autoplay="false"
                    data-nav-for="#thumbProgressNav">
                    @foreach ($sliders as $slider)
                    <div class="js-slide">
                        <div class="row height-410-xl mx-0 justify-content-center align-items-center">
                            {{-- <div class="col-md-4 mt-6 mt-md-0 mb-4 mb-md-0">
                                <div class="ml-xl-8">
                                    <h3 class="font-size-sl-48 font-weight-light mb-1 text-lh-1"
                                        data-scs-animation-delay="50"
                                        data-scs-animation-in="fadeInUp">LIMITED
                                    </h3>
                                    <h1 class="font-size-sl-72 text-lh-1 font-weight-light mb-2 mb-lg-3 mb-wd-4"
                                        data-scs-animation-delay="100"
                                        data-scs-animation-in="fadeInUp">
                                        WEEK DEAL</span>
                                    </h1>
                                    <h6 class="font-size-xl-15 font-weight-bold mb-0"
                                        data-scs-animation-in="fadeInUp"
                                        data-scs-animation-delay="200">HURRY UP BEFORE OFFER WILL END
                                    </h6>
                                </div>
                            </div> --}}
                            <div class="col-md-4 d-flex align-items-center  ml-auto ml-md-0 mb-4 mb-md-0"
                                data-scs-animation-in="zoomIn"
                                data-scs-animation-delay="400">
                                <img class="img-fluid" src="{{ asset($slider->slider_img) }}" alt="Image Description">
                            </div>
                            {{-- <div class="col-md-4"
                                data-scs-animation-in="fadeInRight"
                                data-scs-animation-delay="600">
                                <div class="mr-xl-14">
                                    <h5 class="mb-3 font-size-17 product-item__title text-lh-default"><a href="#" class="text-blue font-weight-bold">Widescreen 4K SUHD TV</a></h5>
                                    <div class="prodcut-price d-flex align-items-end position-relative text-lh-1 mb-5">
                                        <ins class="font-size-34 text-red text-decoration-none">$79.00</ins>
                                        <del class="font-size-18 tex-gray-6 mb-1 ml-2">$99.00</del>
                                    </div>
                                    <div class="js-countdown d-flex mx-n2 justify-content-center justify-content-md-start mb-5"
                                        data-end-date="2020/11/30"
                                        data-hours-format="%H"
                                        data-minutes-format="%M"
                                        data-seconds-format="%S">
                                        <div class="text-lh-1 px-2 text-center">
                                            <div class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-34 mb-2">
                                                    <span class="js-cd-hours"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-12 text-center">HOURS</div>
                                            </div>
                                        </div>
                                        <div class="text-lh-1 px-2 text-center">
                                            <div class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-34 mb-2">
                                                    <span class="js-cd-minutes"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-12 text-center">MINS</div>
                                            </div>
                                        </div>
                                        <div class="text-lh-1 px-2 text-center">
                                            <div class="bg-white rounded-sm border border-width-2 border-primary py-2 px-2 min-width-46">
                                                <div class="text-gray-2 font-size-34 mb-2">
                                                    <span class="js-cd-seconds"></span>
                                                </div>
                                                <div class="text-gray-2 font-size-12 text-center">SECS</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="">Availavle: <strong>6</strong></span>
                                            <span class="">Already Sold: <strong>28</strong></span>
                                        </div>
                                        <div class="rounded-pill bg-gray-3 height-wd-14 height-xl-20 position-relative">
                                            <span class="position-absolute left-0 top-0 bottom-0 rounded-pill w-30 bg-primary"></span>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div id="thumbProgressNav" class="js-slick-carousel u-slick u-slick--transform-off u-slick-thumb-progress__custom mx-xl-3 text-center font-size-13"
                data-autoplay="false"
                data-pagi-classes="d-md-none text-center right-0 bottom-1 left-0 u-slick__pagination u-slick__pagination--long mb-0 z-index-n1 mt-4"
                data-slides-show="5"
                data-is-thumbs="true"
                data-is-thumbs-progress="false"
                data-thumbs-progress-container=".js-slick-thumb-progress"
                data-nav-for="#thumbProgress">
                @foreach ($sliders as $slider)
                <div class="js-slide">
                    <a class="js-slick-thumb-progress" href="javascript:;">
                   
                    </a>
                </div>
                @endforeach
               
                
            </div>
        </div>
    </div>
</div>
<!-- End Slider Section -->
@endif