<?php $__env->startSection('title'); ?>
    Home Page
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <main id="content" role="main">

        <!-- Slider Section -->
        <?php echo $__env->make('frontend.common.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- End Slider Section -->


        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h3 class="mb-0 pb-2 font-size-22 text-center font-weight-bold">Categories</h3>
                        <p class="m-0 text-center">Get Your Desired Product from Category!</p>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters mb-6 justify-content-center">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="product-item mr-2">
                                <div class="js-slide">
                                    <a href="<?php echo e(url('category/product/' . $category->category_slug . '/' . encrypt($category->id))); ?>"
                                        class="d-block text-center bg-on-hover width-122 mx-auto">
                                        <div
                                            class="d-flex justify-content-center align-items-center bg font-size-40 pt-4 rounded-circle-top width-122 height-75">
                                            <img src="<?php echo e($category->category_icon); ?>" alt="">
                                        </div>
                                        <div class="bg-white px-2 pt-2 width-122">
                                            <h6 class="font-weight-semi-bold font-size-14 text-gray-90 mb-0 text-lh-1dot2">
                                                <?php echo e($category->category_name); ?></h6>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
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

                .swiper-slide {
                  text-align: center;
                  font-size: 18px;
                  background: #fff;
                  height: calc((100% - 30px) / 2) !important;

                  /* Center slide text vertically */
                  display: flex;
                  justify-content: center;
                  align-items: center;
                }
              </style>
 <div class="row">
    <div class="col-md-12">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $new_arrival; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="swiper-slide">

                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?php echo e(url('/product/details/' . $item->product_slug . '/' . encrypt($item->id))); ?>"
                                class="d-block text-center"><img class="img-fluid"
                                    src="<?php echo e(asset($item->product_thambnail)); ?>"
                                    alt="Image Description"></a>
                        </div>
                        <div class="col-md-8">
                            <p>
                                <?php echo e($item->product_name); ?>

                            </p>
                        </div>
                    </div>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
    </div>
 </div>
            <div class="row">
                <div class="col-12 col-wd-12gdot5">
                    <div class="mb-2">
                        <h3 class="mb-0 pb-2 font-size-22 text-center font-weight-bold">Featured Products</h3>
                        <p class="m-0 text-center">Check & Get Your Desired Product!</p>
                    </div>
                    <ul class="row list-unstyled products-group no-gutters mb-6">
                        <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="col-6 col-md-2gdot4 product-item">
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
        </div>
    </main>

    <script>
        $(document).ready(function() {
            $("#basicsCollapseOne").addClass('show');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/frontend/index.blade.php ENDPATH**/ ?>