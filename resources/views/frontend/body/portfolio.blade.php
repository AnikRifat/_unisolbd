<div class="container">
    <div class="mb-2">
        <h3 class="mb-0 pb-2 font-size-22 text-center font-weight-bold">Our Solutions</h3>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs justify-content-center" id="myTabs">

        @foreach ($solutions as $key => $solution)
            <li class="nav-item">
                <a class="nav-link btn btn-sm rounded-pill {{ $key == 1 ? 'active' : '' }}" data-toggle="tab" href="#{{ $solution->title }}">{{ $solution->title }}</a>
            </li>
        @endforeach

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">

        @foreach ($solutions as $key => $solution)
            <div class="tab-pane container tab-content-item {{ $key == 1 ? 'active' : '' }}" id="{{ $solution->title }}">
                <div class="portfolio-wrapper">
                    <div class="portfolio-image">
                        <img src="{{ asset($solution->image) }}" alt="..." />
                    </div>
                    <div class="portfolio-overlay">
                        <div class="portfolio-content">
                            <a class="popimg ml-0" href="#">
                                <i class="ti-zoom-in display-24 display-md-23 display-lg-22 display-xl-20"></i>
                            </a>
                            <h4>{{ $solution->name }}</h4>
                            <p>{{ $solution->short_description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

</div>

<script>
    $(document).ready(function() {
        var $tabs = $('#myTabs .nav-link');
        var $tabContentItems = $('.tab-content-item');
        var currentTab = 0;

        setInterval(function() {
            $tabs.eq(currentTab).removeClass('active');
            $tabContentItems.eq(currentTab).removeClass('active');
            currentTab = (currentTab + 1) % $tabs.length;
            $tabs.eq(currentTab).addClass('active').tab('show');
            $tabContentItems.eq(currentTab).addClass('active');
        }, 2000);
    });
</script>
