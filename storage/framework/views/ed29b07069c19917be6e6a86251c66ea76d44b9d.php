        <div class="row no-gutters">
            <div class="filtering col-sm-12 text-center">
                <span data-filter="*" class="active">All</span>
                <span data-filter=".architecture" class="">Architecture</span>
                <span data-filter=".decor" class="">Decor</span>
                <span data-filter=".interior" class="">Interior</span>
            </div>
            <div class="col-12 text-center w-100">
                <div class="form-row gallery">
                    <div class="col-sm-6 col-lg-4 mb-2 interior">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-image">
                                <img src="https://www.bootdey.com/image/350x350/FFB6C1/000000" alt="..." />
                            </div>
                            <div class="portfolio-overlay">
                                <div class="portfolio-content">
                                    <a class="popimg ml-0" href="#">
                                        <i class="ti-zoom-in display-24 display-md-23 display-lg-22 display-xl-20"></i>
                                    </a>
                                    <h4>Stylish Family Appartment</h4>
                                    <p>[Interior]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-2 decor interior">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-image">
                                <img src="https://www.bootdey.com/image/350x350/87CEFA/000000" alt="..." />
                            </div>
                            <div class="portfolio-overlay">
                                <div class="portfolio-content">
                                    <a class="popimg ml-0" href="#">
                                        <i class="ti-zoom-in display-24 display-md-23 display-lg-22 display-xl-20"></i>
                                    </a>
                                    <h4>Minimal Guests House</h4>
                                    <p>[Decor, Interior]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-2 architecture">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-image">
                                <img src="https://www.bootdey.com/image/350x350/C71585/000000" alt="..." />
                            </div>
                            <div class="portfolio-overlay">
                                <div class="portfolio-content">
                                    <a class="popimg ml-0" href="#">
                                        <i class="ti-zoom-in display-24 display-md-23 display-lg-22 display-xl-20"></i>
                                    </a>
                                    <h4>Kitchen for Small family</h4>
                                    <p>[Architecture]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-2 mb-lg-0 interior">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-image">
                                <img src="https://www.bootdey.com/image/350x350/20B2AA/000000" alt="..." />
                            </div>
                            <div class="portfolio-overlay">
                                <div class="portfolio-content">
                                    <a class="popimg ml-0" href="#">
                                        <i class="ti-zoom-in display-24 display-md-23 display-lg-22 display-xl-20"></i>
                                    </a>
                                    <h4>Interior Design for Bathroom</h4>
                                    <p>[Interior]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 mb-2 mb-sm-0 architecture">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-image">
                                <img src="https://www.bootdey.com/image/350x350/FFA07A/000000" alt="..." />
                            </div>
                            <div class="portfolio-overlay">
                                <div class="portfolio-content">
                                    <a class="popimg ml-0" href="#">
                                        <i class="ti-zoom-in display-24 display-md-23 display-lg-22 display-xl-20"></i>
                                    </a>
                                    <h4>Art Family Residence</h4>
                                    <p>[Architecture]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 decor">
                        <div class="portfolio-wrapper">
                            <div class="portfolio-image">
                                <img src="https://www.bootdey.com/image/350x350/9932CC/000000" alt="..." />
                            </div>
                            <div class="portfolio-overlay">
                                <div class="portfolio-content">
                                    <a class="popimg ml-0" href="#">
                                        <i class="ti-zoom-in display-24 display-md-23 display-lg-22 display-xl-20"></i>
                                    </a>
                                    <h4>Luxury Bathroom Interior</h4>
                                    <p>[Decor]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php $__env->startPush('js'); ?>
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
        <?php $__env->stopPush(); ?>
<?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/frontend/body/portfolio.blade.php ENDPATH**/ ?>