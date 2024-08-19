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
