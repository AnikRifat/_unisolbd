<?php
$sliders=App\Models\Slider::where('status',1)->where('type',1)->orderBy('id','DESC')->get();
//$sliders=null;
?>


<?php if(count($sliders)): ?>
 <!-- Slider Section -->
 <div class="mb-8">
    <div class="container">
        <div class="overflow-hidden">
            <div class="bg-img-hero min-height-420" style="background-image: url(frontendassets/img/1400X420/img1.jpg);">
                <div id="thumbProgress" class="js-slick-carousel u-slick"
                    data-autoplay="false"
                    data-nav-for="#thumbProgressNav">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="js-slide">
                        <div class="row height-410-xl mx-0 justify-content-center align-items-center">
                            
                            <div class="col-md-4 d-flex align-items-center  ml-auto ml-md-0 mb-4 mb-md-0"
                                data-scs-animation-in="zoomIn"
                                data-scs-animation-delay="400">
                                <img class="img-fluid" src="<?php echo e(asset($slider->slider_img)); ?>" alt="Image Description">
                            </div>
                            
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="js-slide">
                    <a class="js-slick-thumb-progress" href="javascript:;">
                   
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
                
            </div>
        </div>
    </div>
</div>
<!-- End Slider Section -->
<?php endif; ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/frontend/common/slider.blade.php ENDPATH**/ ?>