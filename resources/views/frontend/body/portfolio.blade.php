<div class="container">
    <div class="row no-gutters">
        <div class="filtering col-sm-12 text-center">

            <span data-filter="*" class="active">All</span>
            @foreach ($solutions as $solution)
            <span data-filter=".{{ $solution->name }}" class="">{{ $solution->name }}</span>

            @endforeach
        </div>
        <div class="col-12 text-center w-100">
            <div class="form-row gallery">
                @foreach ($solutions as $solution)
                <div class=" col-lg-12 mb-2 {{ $solution->name }}">
                    <div class="portfolio-wrapper">
                        <div class="portfolio-image">
                            <img src="{{ asset($solution->image) }}" alt="..." />
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-content">
                                <a class="popimg ml-0" href="#">
                                    <i class="ti-zoom-in display-24 display-md-23 display-lg-22 display-xl-20"></i>
                                </a>
                                <h4>{{ $solution->title }}</h4>
                                <p>{{ $solution->short_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>


    @push('js')
    <script>
        $(function(){
        $(".filtering").on("click", "span", function () {
            var a = $(".gallery").isotope({});
            var e = $(this).attr("data-filter");
            a.isotope({ filter: e });
        });
        $(".filtering").on("click", "span", function () {
            $(this).addClass("active").siblings().removeClass("active");
        });
    });
    </script>
    @endpush

</div>
