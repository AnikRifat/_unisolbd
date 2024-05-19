<?php
    $setting = App\Models\SiteSetting::limit(1)
        ->get()
        ->first();

    $products = App\Models\Product::get();

    $products = $products->map(function ($product) {
        $product->enc_id = Crypt::encrypt($product->id);
        return $product;
    });

?>
<!DOCTYPE html>
<html lang="en">


<head>

    <!-- Title -->
    <title><?php echo e($setting->company_name); ?></title>

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset($setting->logo)); ?>">


    <!-- Google Fonts -->
    

    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/auto-complete/jquery-ui.css')); ?>">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/vendor/font-awesome/css/fontawesome-all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/css/font-electro.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/vendor/ion-rangeslider/css/ion.rangeSlider.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/vendor/animate.css/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/vendor/hs-megamenu/src/hs.megamenu.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/vendor/fancybox/jquery.fancybox.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/vendor/slick-carousel/slick/slick.css')); ?>">
    <link rel="stylesheet"
        href="<?php echo e(asset('frontendassets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')); ?>">


    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="<?php echo e(asset('frontendassets/css/theme.css')); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    
</head>

<body>
    <!-- ========== HEADER ========== -->
    <?php echo $__env->make('frontend.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <?php echo $__env->yieldContent('content'); ?>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- ========== FOOTER ========== -->
    <?php echo $__env->make('frontend.body.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- ========== END FOOTER ========== -->

    <!-- ========== SECONDARY CONTENTS ========== -->
    <!-- Account Sidebar Navigation -->

    <!-- End Account Sidebar Navigation -->
    <!-- ========== END SECONDARY CONTENTS ========== -->

    <!-- Go to Top -->
    <a class="js-go-to u-go-to" href="#" data-position='{"bottom": 15, "right": 15 }' data-type="fixed"
        data-offset-top="400" data-compensation="#header" data-show-effect="slideInUp" data-hide-effect="slideOutDown">
        <span class="fas fa-arrow-up u-go-to__inner"></span>
    </a>
    <!-- End Go to Top -->

    <!-- JS Global Compulsory -->
    <script src="<?php echo e(asset('frontendassets/vendor/jquery/dist/jquery.min.js')); ?>"></script>


    <script src="<?php echo e(asset('frontendassets/vendor/jquery-migrate/dist/jquery-migrate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/vendor/popper.js/dist/umd/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/vendor/bootstrap/bootstrap.min.js')); ?>"></script>

    <!-- JS Implementing Plugins -->
    
    
    <script src="<?php echo e(asset('frontendassets/vendor/hs-megamenu/src/hs.megamenu.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/vendor/svg-injector/dist/svg-injector.min.js')); ?>"></script>
    <script
        src="<?php echo e(asset('frontendassets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')); ?>">
    </script>
    
    
    
    <script src="<?php echo e(asset('frontendassets/vendor/slick-carousel/slick/slick.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')); ?>"></script>

    <!-- JS Electro -->
    <script src="<?php echo e(asset('frontendassets/js/hs.core.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.countdown.js')); ?>"></script>

    <script src="<?php echo e(asset('frontendassets/js/components/hs.header.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.hamburgers.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.unfold.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.focus-state.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.malihu-scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.validation.js')); ?>"></script>


    <script src="<?php echo e(asset('frontendassets/js/components/hs.fancybox.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.onscroll-animation.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.slick-carousel.js')); ?>"></script>
    

    
    <script src="<?php echo e(asset('frontendassets/js/components/hs.show-animation.js')); ?>"></script>
    
    <script src="<?php echo e(asset('frontendassets/js/components/hs.svg-injector.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.go-to.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/js/components/hs.selectpicker.js')); ?>"></script>
    <script src="<?php echo e(asset('frontendassets/auto-complete/jquery-ui.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/fuse.js/dist/fuse.min.js"></script>


    <!-- JS Plugins Init. -->
    <script>
        $(window).on('load', function() {
            // initialization of HSMegaMenu component
            $('.js-mega-menu').HSMegaMenu({
                event: 'hover',
                direction: 'horizontal',
                pageContainer: $('.container'),
                breakpoint: 767.98,
                hideTimeOut: 0
            });

            // initialization of svg injector module
            $.HSCore.components.HSSVGIngector.init('.js-svg-injector');
        });

        $(document).on('ready', function() {
            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of animation
            $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                afterOpen: function() {
                    $(this).find('input[type="search"]').focus();
                }
            });

            // initialization of popups
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of countdowns
            var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                yearsElSelector: '.js-cd-years',
                monthsElSelector: '.js-cd-months',
                daysElSelector: '.js-cd-days',
                hoursElSelector: '.js-cd-hours',
                minutesElSelector: '.js-cd-minutes',
                secondsElSelector: '.js-cd-seconds'
            });

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of forms
            $.HSCore.components.HSFocusState.init();

            // initialization of form validation
            $.HSCore.components.HSValidation.init('.js-validate', {
                rules: {
                    confirmPassword: {
                        equalTo: '#signupPassword'
                    }
                }
            });

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // initialization of fancybox
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

            // initialization of go to
            $.HSCore.components.HSGoTo.init('.js-go-to');

            // initialization of hamburgers
            $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                beforeClose: function() {
                    $('#hamburgerTrigger').removeClass('is-active');
                },
                afterClose: function() {
                    $('#headerSidebarList .collapse.show').collapse('hide');
                }
            });

            $('#headerSidebarList [data-toggle="collapse"]').on('click', function(e) {
                e.preventDefault();

                var target = $(this).data('target');

                if ($(this).attr('aria-expanded') === "true") {
                    $(target).collapse('hide');
                } else {
                    $(target).collapse('show');
                }
            });

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of select picker
            $.HSCore.components.HSSelectPicker.init('.js-select');
        });
    </script>

    <script>
        $(function() {
            var showSeeAllButton = true; // Default to showing the button

            var availableTags = <?php echo json_encode($products); ?>;

            var options = {
                keys: ['product_name'],
                threshold: 0.3,
            };

            var fuse = new Fuse(availableTags, options);

            $(".searchproduct-item").autocomplete({
                source: function(request, response) {
                    var results = fuse.search(request.term);
                    var filteredTags = results.map(result => result.item);

                    if (filteredTags.length <= 5) {
                        showSeeAllButton = false; // Hide the button
                    } else {
                        showSeeAllButton = true; // Show the button
                    }

                    if (filteredTags.length === 0) {
                        filteredTags.push({
                            product_name: 'No products found'
                        });
                    }

                    // Show up to 5 products in the autocomplete results
                    var limitedResults = filteredTags.slice(0, 5);
                    response(limitedResults);
                },
                open: function(event, ui) {
                    if (showSeeAllButton) {
                        var search = $("#searchproduct-item").val();
                        $(".ui-autocomplete").append(
                            '<li class="see-all-results">' +
                            '<a href="/product/search?search=' + search +
                            '" class="btn btn-soft-primary rounded-0 btn-block mt-2">See all results</a>' +
                            '</li>'
                        );
                    }
                }
            }).autocomplete("instance")._renderItem = function(ul, item) {
                if (item.product_name === 'No products found') {
                    return $(
                            '<li class="text-center text-danger py-10 font-size-16 font-weight-bold">No products found</li>'
                        ).appendTo(ul)
                        .css("cursor", "default"); // Set cursor to default to prevent the hand cursor
                }

                function formatNumberWithCommas(number) {
                    return new Intl.NumberFormat().format(number);
                }

                var listItem = $("<li>")
                    .append(
                        $('<a>').attr('href', '/product/details/' + item.product_slug + '/' + item.enc_id)
                        .append(
                            '<div class="d-flex align-items-center p-2">' +
                            '<div class="mr-3"><img src="' + '/' + item.product_thambnail + '" alt="' + item
                            .product_name + '" style="height:50px;width:50px"/></div>' +
                            '<div class="">' +
                            '<div>' + item.product_name + '</div>' +
                            '<?php if(auth()->guard()->check()): ?><div class="mt-1 text-danger">' + (item.discount_price != null ?
                                formatNumberWithCommas(item.discount_price) : formatNumberWithCommas(item
                                    .selling_price)) +
                            '</div><?php endif; ?>' +
                            '</div>' +
                            '</div>'
                        )
                    )
                    .appendTo(ul);

                return listItem;
            };

            $(".searchproduct-item-mobile").autocomplete({
                source: function(request, response) {
                    var results = fuse.search(request.term);
                    var filteredTags = results.map(result => result.item);

                    if (filteredTags.length <= 5) {
                        showSeeAllButton = false; // Hide the button
                    } else {
                        showSeeAllButton = true; // Show the button
                    }

                    if (filteredTags.length === 0) {
                        filteredTags.push({
                            product_name: 'No products found'
                        });
                    }

                    // Show up to 5 products in the autocomplete results
                    var limitedResults = filteredTags.slice(0, 5);
                    response(limitedResults);
                },
                open: function(event, ui) {
                    if (showSeeAllButton) {
                        $(".ui-autocomplete").append(
                            '<li class="see-all-results">' +
                            '<a href="#" class="btn btn-soft-primary rounded-0 btn-block mt-2">See all results</a>' +
                            '</li>'
                        );
                    }
                }
            }).autocomplete("instance")._renderItem = function(ul, item) {
                if (item.product_name === 'No products found') {
                    return $(
                            '<li class="text-center text-danger py-10 font-size-16 font-weight-bold">No products found</li>'
                        ).appendTo(ul)
                        .css("cursor", "default"); // Set cursor to default to prevent the hand cursor
                }

                function formatNumberWithCommas(number) {
                    return new Intl.NumberFormat().format(number);
                }

                var listItem = $("<li>")
                    .append(
                        $('<a>').attr('href', '/product/details/' + item.product_slug + '/' + item.enc_id)
                        .append(
                            '<div class="d-flex align-items-center p-2">' +
                            '<div class="mr-3"><img src="' + '/' + item.product_thambnail + '" alt="' + item
                            .product_name + '" style="height:50px;width:50px"/></div>' +
                            '<div class="">' +
                            '<div>' + item.product_name + '</div>' +
                            '<?php if(auth()->guard()->check()): ?><div class="mt-1 text-danger">' + (item.discount_price != null ?
                                formatNumberWithCommas(item.discount_price) : formatNumberWithCommas(item
                                    .selling_price)) +
                            '</div><?php endif; ?>' +
                            '</div>' +
                            '</div>'
                        )
                    )
                    .appendTo(ul);

                return listItem;
            };





        });
    </script>

    <script>
        <?php if(Session::has('message')): ?>
            var type = "<?php echo e(Session::get('type', 'info')); ?>";
            switch (type) {
                case 'info':
                    toastr.info("<?php echo e(Session::get('message')); ?>");
                    break;

                case 'warning':
                    toastr.warning("<?php echo e(Session::get('message')); ?>");
                    break;

                case 'success':
                    toastr.success("<?php echo e(Session::get('message')); ?>");
                    break;

                case 'error':
                    toastr.error("<?php echo e(Session::get('message')); ?>");
                    break;
            }
        <?php endif; ?>


        function showToastr(type, message) {
            switch (type) {
                case 'info':
                    toastr.info(message, type);
                    break;
                case 'warning':
                    toastr.warning(message, type);
                    break;
                case 'success':
                    toastr.success(message, type);
                    break;
                case 'error':
                    toastr.error(message, type);
                    break;
                default:
                    toastr.info(message, type);
                    break;
            }
        }
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>

    <script>
        function addToCart(e) {
            // var stock = e.getAttribute('data-stock');

            var encodedProductId = e.getAttribute('data-product-id');
            // Get the quantity input value
            var decodedProductId = atob(encodedProductId);

            var quantity = $('.js-result').val() || 1;
            console.log(quantity + " " + decodedProductId);

            $.ajax({
                type: "post",
                url: "<?php echo e(route('add-to-cart')); ?>",
                data: {
                    id: decodedProductId,
                    qty: quantity
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    toastr.success(response.notification.message, 'Success');
                    getCartData();
                    // console.log(response.cartData.original.cartTotal);
                }
            });

        }


        function getCartData() {
            $.ajax({
                type: "get",
                url: "<?php echo e(route('get-cart-data')); ?>",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    miniCart(response);
                    var route = '<?php echo e(isset($route) ? $route : ''); ?>';
                    console.log(route);
                    if (route == "mycart") {
                        cartPage(response);
                    }

                    if (route == "checkout") {
                        checkoutPage(response);
                    }

                }
            });
        }

        function miniCart(response) {
            cartItemsHtml = ''
            if (response.cartQty > 0) {
                for (const cartKey in response.carts) {
                    console.log('i am cart page')
                    if (response.carts.hasOwnProperty(cartKey)) {
                        const cartItem = response.carts[cartKey];

                        console.log(cartItem.rowId);
                        // Generate the HTML markup for each cart item
                        cartItemsHtml += `
                        <li class="border-bottom pb-3 mb-3">
                            <div>
                                <ul class="list-unstyled row mx-n2">
                                    <li class="px-2 col-auto">
                                        <img class="img-fluid" src="/${cartItem.options.image}" alt="Image Description" style="height:50px;width:50px">
                                    </li>
                                    <li class="px-2 col">
                                        <h5 class="text-blue font-size-14 font-weight-bold">${cartItem.name}</h5>
                                        <span class="font-size-14">${cartItem.qty} × ${cartItem.price}</span>
                                    </li>
                                    <li class="px-2 col-auto">
                                        <a href="javascript:void(0)" onclick="removeCart('${cartItem.rowId}')" class="text-gray-90"><i class="ec ec-close-remove"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    `;
                    }




                }


                $('#cartAction').removeClass('d-none')
            } else {
                cartItemsHtml = '<li class="font-size-14 font-weight-bold">No product is added in the cart</li>'
                $('#cartAction').addClass('d-none')
            }

            // Set the HTML content of the 'miniCart' <ul> with the generated cart items
            $('#miniCart').html(cartItemsHtml);

            // Set the total cart quantity and amount with comma-separated numbers
            $('.totalCartQty').text(response.cartQty);
            $('.totalCartAmt').text(response.cartTotal.toLocaleString('en-IN'));
        }

        function cartPage(response) {
            const emptyCart = $("#emptyCart");


            if (response.carts === null || response.carts.length === 0) {
                $('#cartContainer').hide();
                // Cart is empty, update the empty cart section content
                emptyCart.html(`<div class="container mt-4 mb-md-10">
                <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body cart">
                            <div class="col-sm-12 empty-cart-cls text-center">
                                <img src="<?php echo e(asset('frontend/assets/img/cart.png')); ?>" width="130" height="130"
                                    class="img-fluid mb-4 mr-3">
                                <h3><strong>Your Cart is Empty</strong></h3>
                                <h4>Add something to make me happy 😊</h4>
                                <a href="<?php echo e(route('home')); ?>" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue
                                    shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            `);


            } else {
                let cartItemsHtml = '';

                for (const cartKey in response.carts) {
                    if (response.carts.hasOwnProperty(cartKey)) {
                        const cartItem = response.carts[cartKey];

                        console.log(cartItem.rowId);
                        // Generate the HTML markup for each cart item
                        cartItemsHtml += `
                            <tr class="">
                            <td class="text-center">
                                <a href="javascript:void(0)" onclick="removeCart('${cartItem.rowId}')"
                                    class="text-gray-32 font-size-26">×</a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1"
                                        src="/${cartItem.options.image}" alt="Image Description"></a>
                            </td>
                            <td data-title="Product">
                                <a href="#" class="text-gray-90">${cartItem.name}</a>
                            </td>
                            <td data-title="Price">
                                <span
                                    class="text-danger">${cartItem.price.toLocaleString('en-IN')}${response.currency.symbol}</span>
                            </td>
                            <td data-title="Quantity">
                                <span class="sr-only">Quantity</span>
                                <!-- Quantity -->
                                <div class="border rounded-pill py-1 width-122 w-xl-80 px-3 border-color-1">
                                    <div class="js-quantity row align-items-center">
                                        <div class="col pr-0">
                                            <!-- Add a unique class to each input field based on rowId -->
                                            <input
                                                class="js-result form-control h-auto border-0 rounded p-0 shadow-none cart-qty-input"
                                                type="text" value="${cartItem.qty}"
                                                data-row-id="${cartItem.rowId}">
                                        </div>
                                        <div class="col-auto pr-1">
                                            <!-- Add data attributes to the buttons to identify the associated input field -->
                                            <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                href="javascript:;" data-row-id="${cartItem.rowId}">
                                                <small class="fas fa-minus btn-icon__inner"></small>
                                            </a>
                                            <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                href="javascript:;" data-row-id="${cartItem.rowId}">
                                                <small class="fas fa-plus btn-icon__inner"></small>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Quantity -->
                            </td>
                            <td data-title="Total">
                                <span
                                    class="text-danger">${cartItem.subtotal.toLocaleString('en-IN')}${response.currency.symbol}</span>
                            </td>
                        </tr>
                    `;
                    }
                }


                if (response.hasOwnProperty('couponsData')) {
                    getCouponData(response);
                } else {
                    $('.cart-discount').addClass('d-none');
                    $('.cart-coupon').addClass('d-none');
                    $('.order-total .amount').text(response.cartTotal.toLocaleString('en-IN') + response.currency.symbol);

                }



                // Set the HTML content of the 'miniCart' <ul> with the generated cart items
                $('#cartTbody').html(cartItemsHtml);
                $('.cart-subtotal .amount').text(response.cartTotal.toLocaleString('en-IN') + response.currency.symbol);
                // Set the value for Total
                // Set the total cart quantity and amount with comma-separated numbers
                // $('#totalCartQty').text(response.cartQty);
                // $('#totalCartAmt').text(response.cartTotal.toLocaleString('en-IN'));

            }

        }

        function removeCart(rowId) {
            $.ajax({
                type: "post",
                url: "<?php echo e(route('remove-cart')); ?>",
                data: {
                    rowId: rowId
                },
                dataType: "json",
                success: function(response) {
                    toastr.success(response.notification.message, 'Warning');
                    getCartData();
                }
            });
        }

        function getCouponData(response) {
            let couponsHtml = '';
            // Remove d-none class from cart-discount and cart-coupon
            $('.cart-discount').removeClass('d-none');
            $('.cart-coupon').removeClass('d-none');
            $('.cart-discount .amount').text("-" + response.couponsData.total_discount.toLocaleString('en-IN') +
                response.currency.symbol);
            $('.order-total .amount').text(response.couponsData.total_amount.toLocaleString('en-IN') + response
                .currency.symbol);

            // Loop through individual coupons in couponsData
            for (const couponName in response.couponsData) {
                if (couponName !== 'total_amount' && couponName !== 'total_discount') {
                    const couponData = response.couponsData[couponName];
                    console.log(couponName, couponData); // This will log each coupon data (e.g., abc, xyz, etc.)
                    couponsHtml += `<span class="coupon m-1 p-1 font-size-12"><i
                                                        class="fa-solid fa-tag fa-rotate-90"></i>
                                                    ${couponName} (${couponData.coupon_discount}%)
                                                    <a href="javascript:void(0)" onclick="removeCoupon('${couponName}')" class="text-danger">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </a>
                                                </span>`

                }
            }

            $('#couponList').html(couponsHtml);
        }

        function removeCoupon(coupon) {
            console.log(coupon);
            $.ajax({
                type: "post",
                url: "<?php echo e(route('remove-coupon')); ?>",
                data: {
                    coupon: coupon
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    getCartData();
                }
            });
        }

        function checkoutPage(response) {
            console.log("checkout page response", response);
            let couponsHtml = '';
            // Remove d-none class from cart-discount and cart-coupon

            if (response.couponsData && Object.keys(response.couponsData).length > 0) {
                $('.cart-discount').removeClass('d-none');

                $('.cart-discount .amount').text("-" + response.couponsData.total_discount
                    .toLocaleString('en-IN') +
                    response.currency.symbol);

                $('.order-total .amount').text(response.couponsData.total_amount.toLocaleString('en-IN') +
                    response
                    .currency.symbol);

                //Loop through individual coupons in couponsData
                for (const couponName in response.couponsData) {
                    if (couponName !== 'total_amount' && couponName !== 'total_discount') {
                        const couponData = response.couponsData[couponName];
                        console.log(couponName,
                            couponData); // This will log each coupon data (e.g., abc, xyz, etc.)
                        couponsHtml += `<span class="coupon m-1 p-1 font-size-12"><i
                                                        class="fa-solid fa-tag fa-rotate-90"></i>
                                                    ${couponName} (${couponData.coupon_discount}%)
                                                    <a href="javascript:void(0)" onclick="removeCoupon('${couponName}')" class="text-danger">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </a>
                                                </span>`

                    }
                }

                $('#couponList').html(couponsHtml);
            } else {
                var subtotal = <?php echo e(isset($cartTotal) ? $cartTotal : 0); ?>;
                $('.cart-discount').addClass('d-none');
                $('.order-total .amount').text(subtotal.toLocaleString('en-IN') +
                    response
                    .currency.symbol);
            }

        }


        function addWishlist(element) {
            var productIdEncoded = $(element).data('product');
            var productIdDecoded = atob(productIdEncoded); // Decode the encoded product ID

            console.log('Encoded Product ID:', productIdEncoded);
            console.log('Decoded Product ID:', productIdDecoded);

            $.ajax({
                type: "post",
                url: "<?php echo e(route('add-to-wishlist')); ?>",
                data: {
                    id: productIdDecoded
                },
                dataType: "json",
                success: function(response) {
                    showToastr(response.type, response.message);
                }
            });
        }

        $(document).ready(function() {
            getCartData();
        });
    </script>



<?php echo $__env->yieldPushContent('js'); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\unisolbd\resources\views/frontend/main_master.blade.php ENDPATH**/ ?>