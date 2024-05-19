<?php
    $setting = App\Models\SiteSetting::limit(1)->get()->first();

    $categories = App\Models\Category::where('status', 1)->orderBy('category_name', 'ASC')->get();

?>


<style>
    a {
        text-decoration: none;
    }

    .floating_btn {
        position: absolute;
        top: 45px;
        right: 69px;
        width: 175px;
        /* height: 100px; */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 1000;

    }

    @media (max-width: 1199.98px) {

        .floating_btn {
            top: 80px;
        }
    }

    .floating_btn a {
        padding: 10px;
    }

    @keyframes pulsing {
        to {
            background-image: linear-gradient(318deg, rgba(82, 195, 255, 1) 36%, rgba(88, 104, 162, 1) 75%);
        }
    }

    .contact_icon {
        /* padding: 10px; */
        background: #5868a2 !important;
        color: #fff;
        text-align: center;
        border-radius: 10px;
        box-shadow: 2px 2px 3px #999;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: translatey(0px);
        animation: pulsing 5.5s infinite;
        box-shadow: 0 0 0 0 rgba(88, 104, 162, 1);
        -webkit-animation: pulsing 5.5s infinite cubic-bezier(0.66, 0, 0, 1);
        -moz-animation: pulsing 5.5s infinite cubic-bezier(0.66, 0, 0, 1);
        -ms-animation: pulsing 5.5s infinite cubic-bezier(0.66, 0, 0, 1);
        animation: pulsing 5.5s infinite cubic-bezier(0.66, 0, 0, 1);
        font-weight: normal;
        font-family: sans-serif;
        text-decoration: none !important;
        transition: all 300ms ease-in-out;
    }
</style>

<header id="header" class="u-header u-header-left-aligned-nav">
    <div class="u-header__section">
        <!-- Topbar -->
        <div class="u-header-topbar py-2 d-none d-xl-block">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="topbar-left">
                        <a href="#" class="text-gray-110 font-size-13 hover-on-dark">Welcome to Worldwide
                            Electronics Store</a>
                    </div>
                    <div class="topbar-right ml-auto">
                        <ul class="list-inline mb-0">
                            <li
                                class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="../home/contact-v2.html" class="u-header-topbar__nav-link"><i
                                        class="ec ec-map-pointer mr-1"></i> Store Locator</a>
                            </li>
                            <li
                                class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <a href="../shop/track-your-order.html" class="u-header-topbar__nav-link"><i
                                        class="ec ec-transport mr-1"></i> Track Your Order</a>
                            </li>
                            
                            <li
                                class="list-inline-item mr-0 u-header-topbar__nav-item u-header-topbar__nav-item-border">
                                <!-- Account Sidebar Toggle Button -->
                                


                                <?php if(Auth::guard('web')->check()): ?>
                                    <a href="<?php echo e(route('dashboard')); ?>" role="button" class="u-header-topbar__nav-link"
                                        aria-controls="sidebarContent" aria-haspopup="true" aria-expanded="false"
                                        data-unfold-event="click" data-unfold-hide-on-scroll="false"
                                        data-unfold-target="#sidebarContent" data-unfold-type="css-animation"
                                        data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight"
                                        data-unfold-duration="500"><i class="ec ec-user mr-1"></i>My Profile</a>
                                <?php else: ?>
                                    

                                    <a href="<?php echo e(route('register')); ?>" role="button" class="u-header-topbar__nav-link"
                                        aria-controls="sidebarContent" aria-haspopup="true" aria-expanded="false"
                                        data-unfold-event="click" data-unfold-hide-on-scroll="false"
                                        data-unfold-target="#sidebarContent" data-unfold-type="css-animation"
                                        data-unfold-animation-in="fadeInRight" data-unfold-animation-out="fadeOutRight"
                                        data-unfold-duration="500"><i class="ec ec-user mr-1"></i>Resiger</a><span
                                        class="text-gray-50 mx-1">or</span><a href="<?php echo e(route('login')); ?>" role="button"
                                        class="u-header-topbar__nav-link" aria-controls="sidebarContent"
                                        aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                        data-unfold-hide-on-scroll="false" data-unfold-target="#sidebarContent"
                                        data-unfold-type="css-animation" data-unfold-animation-in="fadeInRight"
                                        data-unfold-animation-out="fadeOutRight" data-unfold-duration="500">Sign
                                        in</a>
                                <?php endif; ?>





                                <!-- End Account Sidebar Toggle Button -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->



        <!-- Logo-Search-header-icons -->
        <div class="py-2 py-xl-5 bg-primary-down-lg">
            <div class="container my-0dot5 my-xl-0">
                <div class="row align-items-center">
                    <!-- Logo-offcanvas-menu -->
                    <div class="col-auto">
                        <!-- Nav -->
                        <nav
                            class="navbar navbar-expand u-header__navbar py-0 justify-content-xl-between max-width-270 min-width-270">
                            <!-- Logo -->
                            <a class="order-1 t3solutionlogo order-xl-0 navbar-brand u-header__navbar-brand u-header__navbar-brand-center"
                                href="<?php echo e(url('/')); ?>" aria-label="trush tech">
                                <img src="<?php echo e(asset($setting->logo)); ?>" alt="">
                            </a>
                            <!-- End Logo -->

                            <!-- Fullscreen Toggle Button -->
                            <button id="sidebarHeaderInvokerMenu" type="button"
                                class="navbar-toggler d-block  btn u-hamburger mr-3 mr-xl-0"
                                aria-controls="sidebarHeader" aria-haspopup="true" aria-expanded="false"
                                data-unfold-event="click" data-unfold-hide-on-scroll="false"
                                data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation"
                                data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                                data-unfold-duration="500">
                                <span id="hamburgerTriggerMenu" class="u-hamburger__box">
                                    <span class="u-hamburger__inner"></span>
                                </span>
                            </button>
                            <!-- End Fullscreen Toggle Button -->
                        </nav>
                        <!-- End Nav -->

                        <!-- ========== HEADER SIDEBAR ========== -->
                        <aside id="sidebarHeader1" class="u-sidebar u-sidebar--left"
                            aria-labelledby="sidebarHeaderInvoker">
                            <div class="u-sidebar__scroller">
                                <div class="u-sidebar__container">
                                    <div class="u-header-sidebar__footer-offset">
                                        <!-- Toggle Button -->
                                        <div class="position-absolute top-0 right-0 z-index-2 pt-4 pr-4 bg-white">
                                            <button type="button" class="close ml-auto" aria-controls="sidebarHeader"
                                                aria-haspopup="true" aria-expanded="false" data-unfold-event="click"
                                                data-unfold-hide-on-scroll="false"
                                                data-unfold-target="#sidebarHeader1" data-unfold-type="css-animation"
                                                data-unfold-animation-in="fadeInLeft"
                                                data-unfold-animation-out="fadeOutLeft" data-unfold-duration="500">
                                                <span aria-hidden="true"><i
                                                        class="ec ec-close-remove text-gray-90 font-size-20"></i></span>
                                            </button>
                                        </div>
                                        <!-- End Toggle Button -->

                                        <!-- Content -->
                                        <div class="js-scrollbar u-sidebar__body">
                                            <div id="headerSidebarContent"
                                                class="u-sidebar__content u-header-sidebar__content">
                                                <!-- Logo -->
                                                <a class="navbar-brand t3solutionlogo u-header__navbar-brand u-header__navbar-brand-center mb-3"
                                                    href="<?php echo e(url('/')); ?>" aria-label="trust tech">

                                                    <img src="<?php echo e(asset($setting->logo)); ?>" alt="">
                                                </a>
                                                <!-- End Logo -->


                                                <?php if(count($categories) > 0): ?>

                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $subcategories = App\Models\Category::select(
                                                                'categories.id',
                                                                'categories.category_name',
                                                                'categories.category_slug',
                                                                DB::raw('IFNULL(brands.id, \'\') AS brand_id'),
                                                                DB::raw(
                                                                    'IFNULL(brands.brand_name, \'\') AS brand_name',
                                                                ),
                                                                DB::raw(
                                                                    'IFNULL(subCategories.id, \'\') AS subcategory_id',
                                                                ),
                                                                DB::raw(
                                                                    'IFNULL(subCategories.subcategory_name, \'\') AS subcategory_name',
                                                                ),
                                                                DB::raw(
                                                                    'IFNULL(subCategories.subcategory_slug, \'\') AS subcategory_slug',
                                                                ),
                                                                DB::raw(
                                                                    'IFNULL(subSubCategories.id, \'\') AS subsubcategory_id',
                                                                ),
                                                                DB::raw(
                                                                    'IFNULL(subSubCategories.subsubcategory_name, \'\') AS subsubcategory_name',
                                                                ),
                                                            )
                                                                ->leftJoin(
                                                                    'products',
                                                                    'categories.id',
                                                                    '=',
                                                                    'products.category_id',
                                                                )
                                                                ->leftJoin(
                                                                    'brands',
                                                                    'products.brand_id',
                                                                    '=',
                                                                    'brands.id',
                                                                )
                                                                ->leftJoin(
                                                                    'sub_categories as subCategories',
                                                                    'products.subcategory_id',
                                                                    '=',
                                                                    'subCategories.id',
                                                                )
                                                                ->leftJoin(
                                                                    'sub_sub_categories as subSubCategories',
                                                                    'products.subsubcategory_id',
                                                                    '=',
                                                                    'subSubCategories.id',
                                                                )
                                                                ->where('categories.id', $category->id)
                                                                ->where('subCategories.status', 1)
                                                                ->groupBy(
                                                                    'categories.id',
                                                                    'categories.category_name',
                                                                    'categories.category_slug',
                                                                    'brands.id',
                                                                    'brands.brand_name',
                                                                    'subCategories.id',
                                                                    'subCategories.subcategory_name',
                                                                    'subCategories.subcategory_slug',
                                                                    'subSubCategories.id',
                                                                    'subSubCategories.subsubcategory_name',
                                                                )
                                                                ->get();

                                                            $hasBrandOrSubcategoryId = collect(
                                                                $subcategories,
                                                            )->contains(
                                                                fn($item) => (isset($item['brand_id']) &&
                                                                    !empty($item['brand_id'])) ||
                                                                    (isset($item['subcategory_id']) &&
                                                                        !empty($item['subcategory_id'])),
                                                            );
                                                            $subcategoriesArray = [];

                                                        ?>





                                                        <!-- List -->
                                                        <ul id="headerSidebarList" class="u-header-collapse__nav">
                                                            <!-- Cameras, Audio & Video -->
                                                            <li class="u-has-submenu u-header-collapse__submenu">
                                                                <div class="d-flex justify-content-between">
                                                                    <a href="<?php echo e(url('category/product/' . $category->category_slug . '/' . encrypt($category->id))); ?>"
                                                                        class="u-header-collapse__nav-link">
                                                                        <?php echo e($category->category_name); ?>

                                                                    </a>
                                                                    <a class="u-header-collapse__nav-link <?php echo e($hasBrandOrSubcategoryId ? 'u-header-collapse__nav-pointer' : ''); ?>  p-0 pl-3"
                                                                        href="javascript:;"
                                                                        data-target="#headerSidebarCategoryCollapse<?php echo e($category->id); ?>"
                                                                        role="button" data-toggle="collapse"
                                                                        aria-expanded="false"
                                                                        aria-controls="headerSidebarCategoryCollapse<?php echo e($category->id); ?>"></a>
                                                                </div>







                                                                <div id="headerSidebarCategoryCollapse<?php echo e($category->id); ?>"
                                                                    class="collapse">
                                                                    
                                                                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                            $subsubcategories = App\Models\Product::where(
                                                                                'subcategory_id',
                                                                                $subcat->subcategory_id,
                                                                            )
                                                                                ->where('status', 1)
                                                                                ->get();

                                                                            $hasBrandOrSubSubcategory = collect(
                                                                                $subsubcategories,
                                                                            )->contains(
                                                                                fn($item) => (isset(
                                                                                    $item['brand_id'],
                                                                                ) &&
                                                                                    !empty($item['brand_id'])) ||
                                                                                    (isset(
                                                                                        $item['subsubcategory_id'],
                                                                                    ) &&
                                                                                        !empty(
                                                                                            $item['subsubcategory_id']
                                                                                        )),
                                                                            );

                                                                            $subsubcategoriesArray = [];
                                                                            $subsubBrandArray = [];
                                                                        ?>

                                                                        <?php if($subcat->subcategory_id != ''): ?>
                                                                            
                                                                            <?php if(!in_array($subcat->subcategory_id, $subcategoriesArray)): ?>
                                                                                <?php
                                                                                    $subcategoriesArray[] =
                                                                                        $subcat->subcategory_id;
                                                                                ?>
                                                                                <ul id="headerSidebarList"
                                                                                    class="u-header-collapse__nav-list u-header-collapse__nav">
                                                                                    <!-- Cameras, Audio & Video -->
                                                                                    <li
                                                                                        class="u-has-submenu u-header-collapse__submenu">
                                                                                        <div
                                                                                            class="d-flex justify-content-between">
                                                                                            <a href="<?php echo e(url('subcategory/product/' . $subcat->subcategory_slug . '/' . encrypt($subcat->subcategory_id))); ?>"
                                                                                                class="u-header-collapse__nav-link">
                                                                                                <?php echo e($subcat->subcategory_name); ?>


                                                                                            </a>
                                                                                            <a class="u-header-collapse__nav-link <?php echo e($hasBrandOrSubSubcategory ? 'u-header-collapse__nav-pointer' : ''); ?> p-0 pl-3"
                                                                                                href="javascript:;"
                                                                                                data-target="#headerSidebarSubcategoryCollapse<?php echo e($subcat->subcategory_id); ?>"
                                                                                                role="button"
                                                                                                data-toggle="collapse"
                                                                                                aria-expanded="false"
                                                                                                aria-controls="headerSidebarSubcategoryCollapse<?php echo e($subcat->subcategory_id); ?>"></a>
                                                                                        </div>

                                                                                        <div id="headerSidebarSubcategoryCollapse<?php echo e($subcat->subcategory_id); ?>"
                                                                                            class="collapse">




                                                                                            <?php $__currentLoopData = $subsubcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                <?php if($subsubcat->subsubcategory_id != null): ?>
                                                                                                    <?php if(!in_array($subsubcat->subsubcategory_id, $subsubcategoriesArray)): ?>
                                                                                                        <?php

                                                                                                            $subsubcategoriesArray[] =
                                                                                                                $subsubcat->subsubcategory_id;

                                                                                                        ?>
                                                                                                        <ul id="headerSidebarList"
                                                                                                            class="u-header-collapse__nav-list">
                                                                                                            <!-- Cameras, Audio & Video -->
                                                                                                            <li
                                                                                                                class="u-has-submenu u-header-collapse__submenu">
                                                                                                                <div
                                                                                                                    class="d-flex justify-content-between">
                                                                                                                    <a href="<?php echo e(url('subsubcategory/product/' . $subsubcat->subsubcategory->subsubcategory_slug . '/' . encrypt($subsubcat->subsubcategory_id))); ?>"
                                                                                                                        class="u-header-collapse__nav-link">
                                                                                                                        <?php echo e($subsubcat->subsubcategory->subsubcategory_name); ?>

                                                                                                                    </a>
                                                                                                                    <a class="u-header-collapse__nav-link <?php echo e($hasBrandOrSubSubcategory ? 'u-header-collapse__nav-pointer' : ''); ?> p-0 pl-3"
                                                                                                                        href="javascript:;"
                                                                                                                        data-target="#headerSidebarSubsubcategoryCollapse<?php echo e($subsubcat->subsubcategory_id); ?>"
                                                                                                                        role="button"
                                                                                                                        data-toggle="collapse"
                                                                                                                        aria-expanded="false"
                                                                                                                        aria-controls="headerSidebarSubsubcategoryCollapse<?php echo e($subsubcat->subsubcategory_id); ?>"></a>
                                                                                                                </div>

                                                                                                                <?php if($subsubcat->brand_id != ''): ?>
                                                                                                                    <div id="headerSidebarSubsubcategoryCollapse<?php echo e($subsubcat->subsubcategory_id); ?>"
                                                                                                                        class="collapse"
                                                                                                                        data-parent="#headerSidebarContent">
                                                                                                                        <ul
                                                                                                                            class="u-header-collapse__nav-list">
                                                                                                                            <li><a class="u-header-collapse__submenu-nav-link"
                                                                                                                                    href="<?php echo e(url('brand_wise_subsubcategory/product/' . $subsubcat->subsubcategory->subsubcategory_slug . '/' . encrypt($subsubcat->subsubcategory_id) . '/' . base64_encode($subsubcat->brand_id))); ?>"><?php echo e($subsubcat->brand->brand_name); ?></a>
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </div>
                                                                                                                <?php endif; ?>

                                                                                                            </li>
                                                                                                            <!-- End Cameras, Audio & Video -->
                                                                                                        </ul>
                                                                                                    <?php endif; ?>
                                                                                                <?php else: ?>
                                                                                                    
                                                                                                    <?php if($subsubcat->brand_id != ''): ?>
                                                                                                        <?php if(!in_array($subsubcat->brand_id, $subsubBrandArray)): ?>
                                                                                                            <?php

                                                                                                                $subsubBrandArray[] =
                                                                                                                    $subsubcat->brand_id;

                                                                                                            ?>
                                                                                                            <ul
                                                                                                                class="u-header-collapse__nav-list">
                                                                                                                <li><a class="u-header-collapse__submenu-nav-link"
                                                                                                                        href="<?php echo e(url('brand_wise_subcategory/product/' . $subsubcat->subcategory->subcategory_slug . '/' . encrypt($subsubcat->subcategory_id) . '/' . base64_encode($subsubcat->brand_id))); ?>">
                                                                                                                        <?php echo e($subsubcat->brand->brand_name); ?></a>
                                                                                                                </li>
                                                                                                            </ul>
                                                                                                        <?php endif; ?>
                                                                                                    <?php endif; ?>
                                                                                                    
                                                                                                <?php endif; ?>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                                                                                        </div>
                                                                                    </li>
                                                                                    <!-- End Cameras, Audio & Video -->
                                                                                </ul>
                                                                            <?php endif; ?>
                                                                            
                                                                        <?php else: ?>
                                                                            
                                                                            <?php if($subcat->brand_id != ''): ?>
                                                                                <ul
                                                                                    class="u-header-collapse__nav-list">
                                                                                    <li><a class="u-header-collapse__submenu-nav-link"
                                                                                            href="<?php echo e(url('brand_wise_category/product/' . $subcat->category_slug . '/' . encrypt($subcat->id) . '/' . base64_encode($subcat->brand_id))); ?>">

                                                                                            <?php echo e($subcat->brand_name); ?></a>
                                                                                    </li>
                                                                                </ul>
                                                                            <?php endif; ?>
                                                                            
                                                                        <?php endif; ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    


                                                                </div>












                                                            </li>
                                                            <!-- End Cameras, Audio & Video -->
                                                        </ul>
                                                        <!-- End List -->
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- End Content -->
                                    </div>
                                    <!-- Footer -->
                                    <footer id="SVGwaveWithDots" class="svg-preloader u-header-sidebar__footer">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item pr-3">
                                                <a class="u-header-sidebar__footer-link text-gray-90"
                                                    href="#">Privacy</a>
                                            </li>
                                            <li class="list-inline-item pr-3">
                                                <a class="u-header-sidebar__footer-link text-gray-90"
                                                    href="#">Terms</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="u-header-sidebar__footer-link text-gray-90" href="#">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                            </li>
                                        </ul>

                                        <!-- SVG Background Shape -->
                                        <div class="position-absolute right-0 bottom-0 left-0 z-index-n1">
                                            <img class="js-svg-injector"
                                                src="<?php echo e(asset('frontendassets/svg/components/wave-bottom-with-dots.svg')); ?>"
                                                alt="Image Description" data-parent="#SVGwaveWithDots">
                                        </div>
                                        <!-- End SVG Background Shape -->
                                    </footer>
                                    <!-- End Footer -->
                                </div>
                            </div>
                        </aside>
                        <!-- ========== END HEADER SIDEBAR ========== -->
                    </div>
                    <!-- End Logo-offcanvas-menu -->
                    <!-- Search Bar -->

                    <div class="col d-none d-xl-block">
                        <form class="js-focus-state">
                            <label class="sr-only" for="searchproduct">Search</label>
                            <div class="input-group">
                                <input type="text"
                                    class="form-control searchproduct-item py-2 pl-5 font-size-15 border-right-0 height-40 border-width-1 rounded-left-pill-custom border-primary"
                                    name="search" id="searchproduct-item" placeholder="Search for Products"
                                    aria-label="Search for Products" aria-describedby="searchProduct1" required>
                                <div class="input-group-append">
                                    <!-- Select -->
                                    
                                    <!-- End Select -->
                                    <button class="btn btn-primary height-40 py-2 px-3 rounded-right-pill"
                                        type="button" id="searchProduct1">
                                        <span class="ec ec-search font-size-24"></span>
                                    </button>
                                </div>
                            </div>
                        </form>



                    </div>

                    <!-- End Search Bar -->
                    <!-- Header Icons -->
                    <div class="col col-xl-auto text-right text-xl-left pl-0 pl-xl-3 position-static">
                        <div class="d-inline-flex">
                            <ul class="d-flex list-unstyled mb-0 align-items-center">

                                <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">
                                    <a type="button" href="<?php echo e(route('view.package')); ?>"
                                        class="btn btn-sm contact_icon text-white ">
                                        Quotation Builder
                                    </a>
                                </li>
                                <li class="col pr-xl-0 px-2 px-sm-3 d-none d-xl-block">
                                    <a type="button" href="<?php echo e(route('storage.calculator')); ?>"
                                        class="btn btn-sm contact_icon text-white ">
                                        Storage Calculator
                                    </a>
                                </li>


                                <li class="col pr-xl-0 px-2 px-sm-3 d-block d-xl-none" href="<?php echo e(route('view.package')); ?>" data-toggle="tooltip"
                                data-placement="top" title="Generate Invoice">
                                    <a  class="text-gray-90">
                                        <span class="ec ec-printer"></span>
                                </li>
                                <li class="col pr-xl-0 px-2 px-sm-3 d-block d-xl-none">
                                    <a  class="text-gray-90" href="<?php echo e(route('storage.calculator')); ?>" data-toggle="tooltip"
                                            data-placement="top" title="Calculate storage for camera">
                                            <span class="ec ec-tvs"></span>

                                </li>
                                <!-- Search -->
                                <li class="col d-xl-none px-2 px-sm-3 position-static">
                                    <a id="searchClassicInvoker"
                                        class="font-size-22 text-gray-90 text-lh-1 btn-text-secondary"
                                        href="javascript:;" role="button" data-toggle="tooltip"
                                        data-placement="top" title="Search" aria-controls="searchClassic"
                                        aria-haspopup="true" aria-expanded="false"
                                        data-unfold-target="#searchClassic" data-unfold-type="css-animation"
                                        data-unfold-duration="300" data-unfold-delay="300"
                                        data-unfold-hide-on-scroll="true" data-unfold-animation-in="slideInUp"
                                        data-unfold-animation-out="fadeOut">
                                        <span class="ec ec-search"></span>
                                    </a>

                                    <!-- Input -->
                                    <div id="searchClassic"
                                        class="dropdown-menu dropdown-unfold dropdown-menu-right left-0 mx-2"
                                        aria-labelledby="searchClassicInvoker">
                                        <form class="js-focus-state input-group px-3 ">
                                            <input class="form-control searchproduct-item-mobile"
                                                id="searchproduct-item-mobile" type="search"
                                                placeholder="Search Product" style="border-radius: 0">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary px-3" type="button"><i
                                                        class="font-size-18 ec ec-search"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End Input -->
                                </li>




                                <!-- End Search -->
                                
                                <li class="col d-xl-none px-2 px-sm-3">
                                    <?php if(Auth::guard('web')->check()): ?>
                                        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-90"
                                            data-toggle="tooltip" data-placement="top" title="Dashboard">
                                            <i class="font-size-22 ec ec-user"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login')); ?>" class="text-gray-90" data-toggle="tooltip"
                                            data-placement="top" title="Login/Register">
                                            <i class="font-size-22 ec ec-user"></i>
                                        </a>
                                    <?php endif; ?>

                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- End Header Icons -->
                </div>
            </div>
        </div>
        <!-- End Logo-Search-header-icons -->

        <!-- Vertical-and-secondary-menu -->
        <div class="d-none d-xl-block container">
            <div class="row">
                <!-- Vertical Menu -->
                <div class="col-md-auto d-none d-xl-block">
                    <div class="max-width-270 min-width-270">
                        <!-- Basics Accordion -->
                        <div id="basicsAccordion">
                            <!-- Card -->
                            <div class="card border-0">
                                <div class="card-header card-collapse border-0" id="basicsHeadingOne">
                                    <button type="button"
                                        class="btn-link btn-remove-focus btn-block d-flex card-btn py-3 text-lh-1 px-4 shadow-none btn-primary rounded-top-lg border-0 font-weight-bold text-gray-90"
                                        data-toggle="collapse" data-target="#basicsCollapseOne" aria-expanded="true"
                                        aria-controls="basicsCollapseOne">
                                        <span class="ml-0 text-gray-90 mr-2 text-white">
                                            <span class="fa fa-list-ul"></span>
                                        </span>
                                        <span class="pl-1 text-gray-90 text-white">Categories</span>
                                    </button>
                                </div>


                                <div id="basicsCollapseOne" class="collapse vertical-menu"
                                    aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion">
                                    <div class="card-body p-0">
                                        <nav
                                            class="js-mega-menu navbar navbar-expand-xl u-header__navbar u-header__navbar--no-space hs-menu-initialized">
                                            <div id="navBar"
                                                class="collapse navbar-collapse u-header__navbar-collapse">
                                                <ul class="navbar-nav u-header__navbar-nav">

                                                    <?php if(count($categories) > 0): ?>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $subcategories = App\Models\Category::select(
                                                                    'categories.id',
                                                                    'categories.category_name',
                                                                    'categories.category_slug',
                                                                    DB::raw('IFNULL(brands.id, \'\') AS brand_id'),
                                                                    DB::raw(
                                                                        'IFNULL(brands.brand_name, \'\') AS brand_name',
                                                                    ),
                                                                    DB::raw(
                                                                        'IFNULL(subCategories.id, \'\') AS subcategory_id',
                                                                    ),
                                                                    DB::raw(
                                                                        'IFNULL(subCategories.subcategory_name, \'\') AS subcategory_name',
                                                                    ),
                                                                    DB::raw(
                                                                        'IFNULL(subCategories.subcategory_slug, \'\') AS subcategory_slug',
                                                                    ),
                                                                    DB::raw(
                                                                        'IFNULL(subSubCategories.id, \'\') AS subsubcategory_id',
                                                                    ),
                                                                    DB::raw(
                                                                        'IFNULL(subSubCategories.subsubcategory_name, \'\') AS subsubcategory_name',
                                                                    ),
                                                                )
                                                                    ->leftJoin(
                                                                        'products',
                                                                        'categories.id',
                                                                        '=',
                                                                        'products.category_id',
                                                                    )
                                                                    ->leftJoin(
                                                                        'brands',
                                                                        'products.brand_id',
                                                                        '=',
                                                                        'brands.id',
                                                                    )
                                                                    ->leftJoin(
                                                                        'sub_categories as subCategories',
                                                                        'products.subcategory_id',
                                                                        '=',
                                                                        'subCategories.id',
                                                                    )
                                                                    ->leftJoin(
                                                                        'sub_sub_categories as subSubCategories',
                                                                        'products.subsubcategory_id',
                                                                        '=',
                                                                        'subSubCategories.id',
                                                                    )
                                                                    ->where('categories.id', $category->id)
                                                                    ->where('subCategories.status', 1)
                                                                    ->groupBy(
                                                                        'categories.id',
                                                                        'categories.category_name',
                                                                        'categories.category_slug',
                                                                        'brands.id',
                                                                        'brands.brand_name',
                                                                        'subCategories.id',
                                                                        'subCategories.subcategory_name',
                                                                        'subCategories.subcategory_slug',
                                                                        'subSubCategories.id',
                                                                        'subSubCategories.subsubcategory_name',
                                                                    )
                                                                    ->get();
                                                                $subcategoriesArray = [];
                                                                $hasBrandOrSubcategory = collect(
                                                                    $subcategories,
                                                                )->contains(
                                                                    fn($item) => (isset($item['brand_id']) &&
                                                                        !empty($item['brand_id'])) ||
                                                                        (isset($item['subcategory_id']) &&
                                                                            !empty($item['subcategory_id'])),
                                                                );

                                                            ?>




                                                            <!-- Nav Item MegaMenu -->
                                                            <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                                data-event="hover" data-position="left">


                                                                <a id="basicMegaMenu2"
                                                                    class="nav-link u-header__nav-link <?php echo e($hasBrandOrSubcategory ? 'u-header__nav-link-toggle' : ''); ?>"
                                                                    href="<?php echo e(url('category/product/' . $category->category_slug . '/' . encrypt($category->id))); ?>"
                                                                    aria-haspopup="true" aria-expanded="false">
                                                                    <?php echo e($category->category_name); ?>

                                                                </a>


                                                                
                                                                <?php if($hasBrandOrSubcategory): ?>
                                                                    <div class="hs-mega-menu vmm-tfw u-header__sub-menu"
                                                                        aria-labelledby="basicMegaMenu2">
                                                                        <ul class="navbar-nav u-header__navbar-nav">

                                                                            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if($subcat->subcategory_id != null): ?>
                                                                                    
                                                                                    <?php if(!in_array($subcat->subcategory_id, $subcategoriesArray)): ?>
                                                                                        <?php
                                                                                            $subsubcategories = App\Models\Product::where(
                                                                                                'subcategory_id',
                                                                                                $subcat->subcategory_id,
                                                                                            )
                                                                                                ->where('status', 1)
                                                                                                ->get();

                                                                                            $hasBrandOrSubSubcategory = collect(
                                                                                                $subsubcategories,
                                                                                            )->contains(
                                                                                                fn($item) => (isset(
                                                                                                    $item['brand_id'],
                                                                                                ) &&
                                                                                                    !empty(
                                                                                                        $item[
                                                                                                            'brand_id'
                                                                                                        ]
                                                                                                    )) ||
                                                                                                    (isset(
                                                                                                        $item[
                                                                                                            'subsubcategory_id'
                                                                                                        ],
                                                                                                    ) &&
                                                                                                        !empty(
                                                                                                            $item[
                                                                                                                'subsubcategory_id'
                                                                                                            ]
                                                                                                        )),
                                                                                            );

                                                                                            $subcategoriesArray[] =
                                                                                                $subcat->subcategory_id;
                                                                                            $brandArray = [];

                                                                                        ?>
                                                                                        <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                                                            data-event="hover"
                                                                                            data-position="left">

                                                                                            <a id="basicMegaMenu3"
                                                                                                class="nav-link u-header__nav-link <?php echo e($hasBrandOrSubSubcategory ? 'u-header__nav-link-toggle' : ''); ?> bg-white"
                                                                                                href="<?php echo e(url('subcategory/product/' . $subcat->subcategory_slug . '/' . encrypt($subcat->subcategory_id))); ?>"
                                                                                                aria-haspopup="true"
                                                                                                aria-expanded="false">
                                                                                                <?php echo e($subcat->subcategory_name); ?>


                                                                                            </a>






                                                                                            <div class="hs-mega-menu vmm-tfw u-header__sub-menu"
                                                                                                aria-labelledby="basicMegaMenu3">
                                                                                                <ul
                                                                                                    class="u-header__sub-menu-nav-group">
                                                                                                    <?php $__currentLoopData = $subsubcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsubcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                        <?php if($subsubcat->subsubcategory_id != null): ?>
                                                                                                            <?php if(!in_array($subsubcat->subsubcategory_id, $subsubcategoriesArray)): ?>
                                                                                                                <?php

                                                                                                                    $subsubcategoriesArray[] =
                                                                                                                        $subsubcat->subsubcategory_id;
                                                                                                                ?>

                                                                                                                <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                                                                                    data-event="hover"
                                                                                                                    data-position="left">

                                                                                                                    <a id="basicMegaMenu4"
                                                                                                                        class="nav-link u-header__nav-link <?php echo e($subsubcat->brand_id != '' ? 'u-header__nav-link-toggle' : ''); ?>  bg-white"
                                                                                                                        href="<?php echo e(url('subsubcategory/product/' . $subsubcat->subsubcategory->subsubcategory_slug . '/' . encrypt($subsubcat->subsubcategory_id))); ?>"
                                                                                                                        aria-haspopup="true"
                                                                                                                        aria-expanded="false">
                                                                                                                        <?php echo e($subsubcat->subsubcategory->subsubcategory_name); ?>


                                                                                                                    </a>



                                                                                                                    <?php if($subsubcat->brand_id != null): ?>
                                                                                                                        <div class="hs-mega-menu vmm-tfw u-header__sub-menu"
                                                                                                                            style="height: 500px"
                                                                                                                            aria-labelledby="basicMegaMenu4">
                                                                                                                            <ul
                                                                                                                                class="u-header__sub-menu-nav-group">

                                                                                                                                <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                                                                                                    data-event="hover"
                                                                                                                                    data-position="left">

                                                                                                                                    <a id="basicMegaMenu5"
                                                                                                                                        class="nav-link u-header__nav-link  bg-white"
                                                                                                                                        href="<?php echo e(url('brand_wise_subsubcategory/product/' . $subsubcat->subsubcategory->subsubcategory_slug . '/' . encrypt($subsubcat->subsubcategory_id) . '/' . base64_encode($subsubcat->brand_id))); ?>"
                                                                                                                                        aria-haspopup="true"
                                                                                                                                        aria-expanded="false">
                                                                                                                                        <?php echo e($subsubcat->brand->brand_name); ?>

                                                                                                                                    </a>

                                                                                                                                </li>

                                                                                                                            </ul>


                                                                                                                        </div>
                                                                                                                    <?php endif; ?>
                                                                                                            <?php endif; ?>



                                                                                        </li>
                                                                                    <?php else: ?>
                                                                                        <?php if($subsubcat->brand_id != ''): ?>
                                                                                            <?php if(!in_array($subsubcat->brand_id, $brandArray)): ?>
                                                                                                <?php

                                                                                                    $brandArray[] =
                                                                                                        $subsubcat->brand_id;
                                                                                                ?>
                                                                                                <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                                                                    data-event="hover"
                                                                                                    data-position="left">

                                                                                                    <a class="nav-link u-header__nav-link bg-white"
                                                                                                        href="<?php echo e(url('brand_wise_subcategory/product/' . $subsubcat->subcategory->subcategory_slug . '/' . encrypt($subsubcat->subcategory_id) . '/' . base64_encode($subsubcat->brand_id))); ?>"
                                                                                                        aria-haspopup="true"
                                                                                                        aria-expanded="false">
                                                                                                        <?php echo e($subsubcat->brand->brand_name); ?>

                                                                                                    </a>

                                                                                                </li>
                                                                                            <?php endif; ?>
                                                                                        <?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </ul>
                                                                    </div>










                                                            </li>
                                                        <?php endif; ?>
                                                        
                                                    <?php else: ?>
                                                        
                                                        <?php if($subcat->brand_id != ''): ?>
                                                            <li class="nav-item hs-has-mega-menu u-header__nav-item"
                                                                data-event="hover" data-position="left">

                                                                <a id="basicMegaMenu3"
                                                                    class="nav-link u-header__nav-link bg-white"
                                                                    href="<?php echo e(url('brand_wise_category/product/' . $subcat->category_slug . '/' . encrypt($subcat->id) . '/' . base64_encode($subcat->brand_id))); ?>"
                                                                    aria-haspopup="true" aria-expanded="false">

                                                                    <?php echo e($subcat->brand_name); ?>

                                                                </a>

                                                            </li>
                                                        <?php endif; ?>
                                                        
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                                </ul>


                                            </div>
                                            <?php endif; ?>








                                            </li>
                                            <!-- End Nav Item MegaMenu-->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </ul>
                                    </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- End Basics Accordion -->
                </div>
            </div>
            <!-- End Vertical Menu -->
            <!-- Secondary Menu -->
            <div class="col">
                <!-- Nav -->
                <nav class="js-mega-menu navbar navbar-expand-md u-header__navbar u-header__navbar--no-space">
                    <!-- Navigation -->
                    <div id="navBar" class="collapse navbar-collapse u-header__navbar-collapse">
                        <ul class="navbar-nav u-header__navbar-nav">
                            <!-- Home -->
                            <li class="nav-item hs-has-mega-menu u-header__nav-item" data-event="click"
                                data-animation-in="slideInUp" data-animation-out="fadeOut" data-position="left">
                                

                                <!-- Home - Mega Menu -->
                                <div class="hs-mega-menu w-100 u-header__sub-menu" aria-labelledby="homeMegaMenu">
                                    <div class="row u-header__mega-menu-wrapper">
                                        <div class="col-md-3">
                                            <span class="u-header__sub-menu-title">Home & Static Pages</span>
                                            <ul class="u-header__sub-menu-nav-group">
                                                <li><a href="index.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Home v1</a>
                                                </li>
                                                <li><a href="home-v2.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Home v2</a>
                                                </li>
                                                <li><a href="home-v3.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Home v3</a>
                                                </li>
                                                <li><a href="home-v3-full-color-bg.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Home v3.1</a>
                                                </li>
                                                <li><a href="home-v4.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Home v4</a>
                                                </li>
                                                <li><a href="home-v5.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Home v5</a>
                                                </li>
                                                <li><a href="home-v6.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Home v6</a>
                                                </li>
                                                <li><a href="home-v7.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Home v7</a>
                                                </li>
                                                <li><a href="about.html"
                                                        class="nav-link u-header__sub-menu-nav-link">About</a></li>
                                                <li><a href="contact-v1.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Contact v1</a>
                                                </li>
                                                <li><a href="contact-v2.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Contact v2</a>
                                                </li>
                                                <li><a href="faq.html"
                                                        class="nav-link u-header__sub-menu-nav-link">FAQ</a></li>
                                                <li><a href="store-directory.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Store
                                                        Directory</a></li>
                                                <li><a href="terms-and-conditions.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Terms and
                                                        Conditions</a></li>
                                                <li><a href="404.html"
                                                        class="nav-link u-header__sub-menu-nav-link">404</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="u-header__sub-menu-title">Shop Pages</span>
                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                                <li><a href="../shop/shop-grid.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Shop Grid</a>
                                                </li>
                                                <li><a href="../shop/shop-grid-extended.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Shop Grid
                                                        Extended</a></li>
                                                <li><a href="../shop/shop-list-view.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Shop List
                                                        View</a></li>
                                                <li><a href="../shop/shop-list-view-small.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Shop List View
                                                        Small</a></li>
                                                <li><a href="../shop/shop-left-sidebar.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Shop Left
                                                        Sidebar</a></li>
                                                <li><a href="../shop/shop-full-width.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Shop Full
                                                        width</a></li>
                                                <li><a href="../shop/shop-right-sidebar.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Shop Right
                                                        Sidebar</a></li>
                                            </ul>
                                            <span class="u-header__sub-menu-title">Product Categories</span>
                                            <ul class="u-header__sub-menu-nav-group">
                                                <li><a href="../shop/product-categories-4-column-sidebar.html"
                                                        class="nav-link u-header__sub-menu-nav-link">4 Column
                                                        Sidebar</a></li>
                                                <li><a href="../shop/product-categories-5-column-sidebar.html"
                                                        class="nav-link u-header__sub-menu-nav-link">5 Column
                                                        Sidebar</a></li>
                                                <li><a href="../shop/product-categories-6-column-full-width.html"
                                                        class="nav-link u-header__sub-menu-nav-link">6 Column Full
                                                        width</a></li>
                                                <li><a href="../shop/product-categories-7-column-full-width.html"
                                                        class="nav-link u-header__sub-menu-nav-link">7 Column Full
                                                        width</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="u-header__sub-menu-title">Single Product Pages</span>
                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                                <li><a href="../shop/single-product-extended.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Single Product
                                                        Extended</a></li>
                                                <li><a href="../shop/single-product-fullwidth.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Single Product
                                                        Fullwidth</a></li>
                                                <li><a href="../shop/single-product-sidebar.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Single Product
                                                        Sidebar</a></li>
                                            </ul>
                                            <span class="u-header__sub-menu-title">Ecommerce Pages</span>
                                            <ul class="u-header__sub-menu-nav-group">
                                                <li><a href="../shop/shop.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Shop</a></li>
                                                <li><a href="../shop/cart.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Cart</a></li>
                                                <li><a href="../shop/checkout.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Checkout</a>
                                                </li>
                                                <li><a href="../shop/my-account.html"
                                                        class="nav-link u-header__sub-menu-nav-link">My Account</a>
                                                </li>
                                                <li><a href="../shop/track-your-order.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Track your
                                                        Order</a></li>
                                                <li><a href="../shop/compare.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Compare</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="u-header__sub-menu-title">Blog Pages</span>
                                            <ul class="u-header__sub-menu-nav-group mb-3">
                                                <li><a href="../blog/blog-v1.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Blog v1</a>
                                                </li>
                                                <li><a href="../blog/blog-v2.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Blog v2</a>
                                                </li>
                                                <li><a href="../blog/blog-v3.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Blog v3</a>
                                                </li>
                                                <li><a href="../blog/blog-full-width.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Blog Full
                                                        Width</a></li>
                                                <li><a href="../blog/single-blog-post.html"
                                                        class="nav-link u-header__sub-menu-nav-link">Single Blog
                                                        Post</a></li>
                                            </ul>
                                            <span class="u-header__sub-menu-title">Shop Columns</span>
                                            <ul class="u-header__sub-menu-nav-group">
                                                <li><a href="../shop/shop-7-columns-full-width.html"
                                                        class="nav-link u-header__sub-menu-nav-link">7 Column Full
                                                        width</a></li>
                                                <li><a href="../shop/shop-6-columns-full-width.html"
                                                        class="nav-link u-header__sub-menu-nav-link">6 Column Full
                                                        width</a></li>
                                                <li><a href="../shop/shop-5-columns-sidebar.html"
                                                        class="nav-link u-header__sub-menu-nav-link">5 Column
                                                        Sidebar</a></li>
                                                <li><a href="../shop/shop-4-columns-sidebar.html"
                                                        class="nav-link u-header__sub-menu-nav-link">4 Column
                                                        Sidebar</a></li>
                                                <li><a href="../shop/shop-3-columns-sidebar.html"
                                                        class="nav-link u-header__sub-menu-nav-link">3 Column
                                                        Sidebar</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Home - Mega Menu -->
                            </li>
                            <!-- End Home -->

                            <!-- Featured Brands -->
                            
                            <!-- End Featured Brands -->

                            <!-- Trending Styles -->
                            
                            <!-- End Trending Styles -->

                            <!-- Gift Cards -->
                            
                            <!-- End Gift Cards -->

                            <!-- Button -->
                            
                            <!-- End Button -->
                        </ul>
                    </div>
                    <!-- End Navigation -->
                </nav>
                <!-- End Nav -->
            </div>
            <!-- End Secondary Menu -->
        </div>
    </div>
    <!-- End Vertical-and-secondary-menu -->
    </div>
</header>
<?php /**PATH C:\xampp\htdocs\unisolbd\resources\views/frontend/body/header.blade.php ENDPATH**/ ?>