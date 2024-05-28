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
    div.swiper-wrapper {
        height: 400px !important;
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
<div class="mb-2">
                        <h3 class="mb-0 pb-2 font-size-22 text-center font-weight-bold">New Arrivals</h3>
                    </div>
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
                                        src="{{ asset($item->product_thambnail) }}" alt="Image Description"></a>
                            </div>
                            <div class="col-md-8">
                                <p>
                                    {{ $item->product_name }}
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
