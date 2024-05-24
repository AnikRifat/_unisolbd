<?php $__env->startSection('content'); ?>
<style>
 .pcbuilder a {
  width: 100%;
  text-align: center;
}
</style>
<main id="content" role="main">
    <!-- breadcrumb -->
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Shop</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <!-- End breadcrumb -->

    <div class="container">
        <div class="mb-8">
            <!-- Shop-control-bar Title -->
            
            <!-- End shop-control-bar Title -->
            <!-- Shop-control-bar -->
            <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                <div class="d-xl-none">
                    <!-- Account Sidebar Toggle Button -->
                    <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;" role="button"
                        aria-controls="sidebarContent1"
                        aria-haspopup="true"
                        aria-expanded="false"
                        data-unfold-event="click"
                        data-unfold-hide-on-scroll="false"
                        data-unfold-target="#sidebarContent1"
                        data-unfold-type="css-animation"
                        data-unfold-animation-in="fadeInLeft"
                        data-unfold-animation-out="fadeOutLeft"
                        data-unfold-duration="500">
                        <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                    </a>
                    <!-- End Account Sidebar Toggle Button -->
                </div>
                <div class="px-3 d-none d-xl-block">
                    <ul class="nav nav-tab-shop" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-one-example1-tab" data-toggle="pill" href="#pills-one-example1" role="tab" aria-controls="pills-one-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    <i class="fa fa-th"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-two-example1-tab" data-toggle="pill" href="#pills-two-example1" role="tab" aria-controls="pills-two-example1" aria-selected="false">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    <i class="fa fa-align-justify"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-three-example1-tab" data-toggle="pill" href="#pills-three-example1" role="tab" aria-controls="pills-three-example1" aria-selected="true">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    <i class="fa fa-list"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-four-example1-tab" data-toggle="pill" href="#pills-four-example1" role="tab" aria-controls="pills-four-example1" aria-selected="true">
                                <div class="d-md-flex justify-content-md-center align-items-md-center">
                                    <i class="fa fa-th-list"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex">
                    <form method="get">
                        <!-- Select -->
                        <select class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"
                            data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                            <option value="one" selected>Default sorting</option>
                            <option value="two">Sort by popularity</option>
                            <option value="three">Sort by average rating</option>
                            <option value="four">Sort by latest</option>
                            <option value="five">Sort by price: low to high</option>
                            <option value="six">Sort by price: high to low</option>
                        </select>
                        <!-- End Select -->
                    </form>
                    <form method="POST" class="ml-2 d-none d-xl-block">
                        <!-- Select -->
                        <select class="js-select selectpicker dropdown-select max-width-120"
                            data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                            <option value="one" selected>Show 20</option>
                            <option value="two">Show 40</option>
                            <option value="three">Show All</option>
                        </select>
                        <!-- End Select -->
                    </form>
                </div>
                <nav class="px-3 flex-horizontal-center text-gray-20 d-none d-xl-flex">
                    <form method="post" class="min-width-50 mr-1">
                        <input size="2" min="1" max="3" step="1" type="number" class="form-control text-center px-2 height-35" value="1">
                    </form> of 3
                    <a class="text-gray-30 font-size-20 ml-2" href="#">→</a>
                </nav>
            </div>
            <!-- End Shop-control-bar -->
            <!-- Shop Body -->
            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade pt-2 show active" id="pills-one-example1" role="tabpanel" aria-labelledby="pills-one-example1-tab" data-target-group="groups">
                    <ul class="row list-unstyled products-group no-gutters">

                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="col-6 col-md-3 col-xl-3 product-item">
                            <div class="product-item__outer h-100">
                                <div class="product-item__inner px-xl-4 p-3">
                                    <div class="product-item__body pb-xl-2">


                                        <h5 class="mb-1 product-item__title"><a href="<?php echo e(url('/product/details/' .$product->product_slug. '/' .encrypt($product->id))); ?>" class="text-blue font-weight-bold"><?php echo e($product->product_name); ?></a></h5>
                                        <div class="mb-2">
                                            <a href="<?php echo e(url('/product/details/' .$product->product_slug. '/' .encrypt($product->id))); ?>" class="d-block text-center"><img class="img-fluid" src="<?php echo e(asset($product->product_thambnail)); ?>" alt="Image Description"></a>
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
                                            <a href="javascript:void(0)"
                                                class="btn btn-primary transition-3d-hover btn-block"><i
                                                    class="ec ec-login"></i>Login to see price</a>
                                        </div>
                                    <?php endif; ?>
                                    </div>
                                    <div>
                                        <div class="pcbuilder border-top pt-3 d-flex justify-content-center align-items-center">
                                            <a href="<?php echo e(route("addToProductPackage", ['product_id' => encrypt($product->id),'package_id' => encrypt($package->id),'key' => encrypt($key)])); ?>" class="btn-primary transition-3d-hover p-2 d-block">Add To <?php echo e($package->name); ?></a>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                    </ul>
                </div>


        <!-- End Brand Carousel -->
    </div>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/_unisolbd/resources/views/frontend/quotationbuilder/view_packagedetails_products.blade.php ENDPATH**/ ?>