<?php $__env->startSection('content'); ?>
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="<?php echo e(url('/')); ?>"><i class="fa fa-home"></i></a>
                            </li>

                            <?php if($product->category_id != null): ?>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                        href="<?php echo e(url('category/product/'.$product->category->category_slug.'/'.encrypt($product->category_id))); ?>"><?php echo e($product->category->category_name); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if($product->subcategory_id != null): ?>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                        href="<?php echo e(url('subcategory/product/'.$product->subcategory->subcategory_slug.'/'.encrypt($product->subcategory_id))); ?>"><?php echo e($product->subcategory->subcategory_name); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if($product->subsubcategory_id != null): ?>
                                <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                        href="<?php echo e(url('subsubcategory/product/'.$product->subsubcategory->subsubcategory_slug .'/'.encrypt($product->subsubcategory_id))); ?>"><?php echo e($product->subsubcategory->subsubcategory_name); ?></a>
                                </li>
                            <?php endif; ?>


                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                                <a
                                    href="<?php echo e(url('/product/details/' .$product->product_slug. '/' .encrypt($product->id))); ?>"> <?php echo e($product->product_name); ?></a>
                               </li>

                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <!-- Single Product Body -->
            <div class="mb-14">
                <div class="row">
                    <div class="col-md-6 col-lg-4 col-xl-5 mb-4 mb-md-0">
                        <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2" data-infinite="true"
                            data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                            data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                            data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                            data-nav-for="#sliderSyncingThumb">
                            <div class="js-slide">
                                <img class="img-fluid" src=" <?php echo e(asset($product->product_thambnail)); ?>"
                                    alt="Image Description">
                            </div>
                            <?php if(count($multiImg) > 0): ?>
                                <?php $__currentLoopData = $multiImg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="js-slide">
                                        <img class="img-fluid" src="<?php echo e(asset($img->photo_name)); ?>" alt="Image Description">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                        </div>

                        <div id="sliderSyncingThumb"
                            class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                            data-infinite="true" data-slides-show="5" data-is-thumbs="true"
                            data-nav-for="#sliderSyncingNav">

                            <div class="js-slide" style="cursor: pointer;">
                                <img class="img-fluid" src=" <?php echo e(asset($product->product_thambnail)); ?>"
                                    alt="Image Description">
                            </div>
                            <?php if($multiImg): ?>
                                <?php $__currentLoopData = $multiImg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="js-slide" style="cursor: pointer;">
                                        <img class="img-fluid" src="<?php echo e(asset($img->photo_name)); ?>" alt="Image Description">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-4 mb-md-6 mb-lg-0">
                        <div class="mb-2">
                            
                            <h2 class="font-size-25 text-lh-1dot2"><?php echo e($product->product_name); ?></h2>

                            <div class="mb-2">
                                <?php echo $product->short_descp; ?>

                            </div>
                            <p><strong>SKU</strong>: <?php echo e($product->product_code); ?></p>
                        </div>
                    </div>
                    <div class="mx-md-auto mx-lg-0 col-md-6 col-lg-4 col-xl-3">
                        <div class="mb-2">
                            <?php if(auth()->guard()->check()): ?>
                            <div class="card p-5 border-width-2 border-color-1 borders-radius-17">
                                <div class="text-gray-9 font-size-14 pb-2 border-color-1 border-bottom mb-3">Availability:
                                    <span class="text-green font-weight-bold"><?php echo e($stock); ?> in stock</span>
                                </div>
                                <div class="mb-3">

                                    <?php if($product->discount_price != null): ?>
                                        <ins
                                            class="font-size-20 text-decoration-none text-danger"><?php echo e(number_format($product->discount_price, 0, '.', ',')); ?><?php echo e($currency->symbol); ?></ins>
                                        <del
                                            class="font-size-16 text-gray-9 ml-2"><?php echo e(number_format($product->selling_price, 0, '.', ',')); ?><?php echo e($currency->symbol); ?></del>
                                    <?php else: ?>
                                        <ins
                                            class="font-size-20 text-decoration-none text-danger"><?php echo e(number_format($product->selling_price, 0, '.', ',')); ?><?php echo e($currency->symbol); ?></ins>
                                    <?php endif; ?>

                                </div>
                                <form method="POST" action="<?php echo e(route('buy', ['id' => base64_encode($product->id)])); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="mb-3">
                                        <h6 class="font-size-14">Quantity</h6>
                                        <!-- Quantity -->
                                        <div class="border rounded-pill py-1 w-md-60 height-35 px-3 border-color-1">
                                            <div class="js-quantity row align-items-center">
                                                <div class="col">
                                                    <input
                                                        class="js-result form-control h-auto border-0 rounded p-0 shadow-none" name="qty"
                                                        type="text" value="1">
                                                </div>
                                                <div class="col-auto pr-1">
                                                    <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                        href="javascript:;">
                                                        <small class="fas fa-minus btn-icon__inner"></small>
                                                    </a>
                                                    <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                        href="javascript:;">
                                                        <small class="fas fa-plus btn-icon__inner"></small>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Quantity -->
                                    </div>

                                    <div class="mb-2 pb-0dot5">
                                        <a href="javascript:void(0)" onclick="addToCart(this)"
                                            data-product-id="<?php echo e(base64_encode($product->id)); ?>" class="btn btn-block btn-primary-dark"><i
                                                class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart</a>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-block btn-dark">Buy Now</button>
                                    </div>
                                </form>
                                <div class="flex-content-center flex-wrap">
                                    <a href="javascript:void(0)" onclick="addWishlist(this)"
                                    data-product="<?php echo e(base64_encode($product->id)); ?>" class="text-gray-6 font-size-13 mr-2"><i
                                            class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                    <a  href="#" class="text-gray-6 font-size-13 ml-2"><i
                                            class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                </div>
                            </div>
                            <div class="prodcut-add-cart">
                                <a href="<?php echo e(route('login')); ?>"
                                    class="btn btn-primary transition-3d-hover btn-block"><i
                                        class="ec ec-login"></i>Login to see price</a>
                            </div>
                        <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Single Product Body -->
        </div>
        <div class="bg-gray-7 pt-6 pb-3 mb-6">
            <div class="container">
                <!-- Single Product Tab -->
                <div class="mb-8">
                    <div class="position-relative position-md-static px-md-6">
                        <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0"
                            id="pills-tab-8" role="tablist">
                            
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link active" id="Jpills-two-example1-tab" data-toggle="pill"
                                    href="#Jpills-two-example1" role="tab" aria-controls="Jpills-two-example1"
                                    aria-selected="false">Description</a>
                            </li>
                            <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                                <a class="nav-link" id="Jpills-three-example1-tab" data-toggle="pill"
                                    href="#Jpills-three-example1" role="tab" aria-controls="Jpills-three-example1"
                                    aria-selected="false">Specification</a>
                            </li>

                        </ul>
                    </div>
                    <!-- Tab Content -->
                    <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9">
                        <div class="tab-content" id="Jpills-tabContent">

                            <div class="tab-pane fade active show" id="Jpills-two-example1" role="tabpanel"
                                aria-labelledby="Jpills-two-example1-tab">
                                <?php echo $product->long_descp; ?>

                            </div>
                            <div class="tab-pane fade" id="Jpills-three-example1" role="tabpanel"
                                aria-labelledby="Jpills-three-example1-tab">
                                <?php echo $product->specification_descp; ?>

                            </div>

                        </div>
                    </div>
                    <!-- End Tab Content -->
                </div>
                <!-- End Single Product Tab -->
            </div>
        </div>

        <div class="container">
            <!-- Related products -->

            <?php if(count($relatedproduct) > 0): ?>
            <div class="row">
                <div class="col-12 col-wd-12gdot4">
                    <div class="border-bottom border-color-1 mb-2">
                        <h3 class="section-title mb-0 pb-2 font-size-22">Related Products</h3>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters mb-6">
                        <?php $__currentLoopData = $relatedproduct; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="col-6 col-md-2 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">

                                        <div class="mb-2">
                                            <?php if($product->subsubcategory_id != null): ?>
                                                <a href="<?php echo e(url('subsubcategory/product/' . $product->subsubcategory->subsubcategory_slug . '/' . encrypt($product->subsubcategory_id))); ?>"
                                                    class="font-size-12 text-gray-5"><?php echo e($product->subsubcategory->subsubcategory_name); ?></a>
                                            <?php elseif($product->subcategory_id != null): ?>
                                                <a href="<?php echo e(url('subcategory/product/' . $product->subcategory->subcategory_slug . '/' . encrypt($product->subcategory_id))); ?>"
                                                    class="font-size-12 text-gray-5"><?php echo e($product->subcategory->subcategory_name); ?></a>
                                            <?php else: ?>
                                                <a href="<?php echo e(url('category/product/' . $product->category->category_slug . '/' . encrypt($product->category_id))); ?>"
                                                    class="font-size-12 text-gray-5"><?php echo e($product->category->category_name); ?></a>
                                            <?php endif; ?>
                                        </div>

                                        <h5 class="mb-1 product-item__title"><a
                                                href="<?php echo e(url('/product/details/' . $product->product_slug . '/' . encrypt($product->id))); ?>"
                                                class="text-blue font-weight-bold" data-toggle="tooltip"
                                                data-placement="top"
                                                title="<?php echo e($product->product_name); ?>"><?php echo e($product->product_name); ?></a>
                                        </h5>
                                        <div class="mb-2">
                                            <a href="<?php echo e(url('/product/details/' . $product->product_slug . '/' . encrypt($product->id))); ?>"
                                                class="d-block text-center"><img class="img-fluid"
                                                    src="<?php echo e(asset($product->product_thambnail)); ?>"
                                                    alt="Image Description"></a>
                                        </div>
                                        <?php if(auth()->guard()->check()): ?>
                                            <div class="flex-center-between mb-1">
                                                <div
                                                    class="prodcut-price d-flex align-items-center flex-wrap position-relative">


                                                    <?php if($product->discount_price != null): ?>
                                                        <ins class="font-size-20 text-red text-decoration-none mr-2">
                                                            <?php echo e(number_format($product->discount_price, 0, '.', ',')); ?><?php echo e($currency->symbol); ?></ins>
                                                        <del
                                                            class="font-size-12 tex-gray-6 position-absolute bottom-100"><?php echo e(number_format($product->selling_price, 0, '.', ',')); ?><?php echo e($currency->symbol); ?></del>
                                                    <?php else: ?>
                                                        <ins class="font-size-20 text-red text-decoration-none mr-2">
                                                            <?php echo e(number_format($product->selling_price, 0, '.', ',')); ?><?php echo e($currency->symbol); ?></ins>
                                                    <?php endif; ?>

                                                </div>
                                                <div class="prodcut-add-cart">
                                                    <a href="javascript:void(0)" onclick="addToCart(this)"
                                                        data-product-id="<?php echo e(base64_encode($product->id)); ?>"
                                                        class="btn-add-cart btn-primary transition-3d-hover"><i
                                                            class="ec ec-add-to-cart"></i></a>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="prodcut-add-cart">
                                                <a href="<?php echo e(route('login')); ?>"
                                                    class="btn btn-primary transition-3d-hover btn-block"><i
                                                        class="ec ec-login"></i>Login to see price</a>
                                            </div>
                                        <?php endif; ?>


                                    </div>
                                    <div class="product-item__footer">
                                        <div class="border-top pt-2 flex-center-between flex-wrap">
                                            <a href="javascript:void(0)" class="text-gray-6 font-size-13"><i
                                                    class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                            <a href="javascript:void(0)"
                                                onclick="addWishlist(this)"data-product="<?php echo e(base64_encode($product->id)); ?>"
                                                class="text-gray-6 font-size-13"><i
                                                    class="ec ec-favorites mr-1 font-size-15"></i>Wishlist</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>

            <!-- End Related products -->

        </div>

    </main>




    <script>
        $(document).ready(function() {
            // Get the input and buttons elements
            var quantityInput = $('.js-result');
            var plusBtn = $('.js-plus');
            var minusBtn = $('.js-minus');

            // Handle the click event for the plus button
            plusBtn.click(function() {
                var currentQuantity = parseInt(quantityInput.val() || '0'); // Convert null to 0
                // Increment the quantity by 1
                var newQuantity = currentQuantity + 1;
                // Update the input value
                quantityInput.val(newQuantity);
            });

            // Handle the click event for the minus button
            minusBtn.click(function() {
                var currentQuantity = parseInt(quantityInput.val() || '1'); // Convert null to 1
                // Decrement the quantity by 1, but ensure it doesn't go below 1
                var newQuantity = Math.max(currentQuantity - 1, 1);
                // Update the input value
                quantityInput.val(newQuantity);
            });

            // Handle manual input to prevent entering 0 at the first and set null to 1
            quantityInput.on('input', function() {
                var currentQuantity = parseInt(quantityInput.val() || '1'); // Convert null to 1
                // Ensure the value is not 0 and not null
                if (currentQuantity === 0 || isNaN(currentQuantity)) {
                    quantityInput.val('1'); // Set to 1 if invalid input
                }
            });

            // Handle focusout event to set value to 1 if empty or null
            quantityInput.on('focusout', function() {
                if (($('.js-result').val() == "") || $('.js-result').val() === 0) {
                    $('.js-result').val(1); // Set to 1 if empty or null
                }
            });
        });
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/frontend/product/product_details.blade.php ENDPATH**/ ?>