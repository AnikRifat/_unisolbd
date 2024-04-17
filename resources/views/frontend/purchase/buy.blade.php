@extends('frontend.main_master')

@section('title')
    Checkout List Page
@endsection

@section('content')
    <style>
        .coupon {
            background-color: #dcdde1;
            border-radius: 50px;
            white-space: nowrap;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <main id="content" role="main" class="checkout-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Checkout
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">
            <div class="mb-5">
                <h1 class="text-center">Checkout</h1>
            </div>
            <!-- Accordion -->
            <div id="shopCartAccordion" class="accordion rounded mb-5">
                <!-- Card -->
                <div class="card border-0">
                    <div id="shopCartHeadingOne" class="alert alert-dark mb-0" role="alert">
                        Returning customer? <a href="#" class="alert-link" data-toggle="collapse"
                            data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">Click here to
                            login</a>
                    </div>
                    <div id="shopCartOne" class="collapse border border-top-0" aria-labelledby="shopCartHeadingOne"
                        data-parent="#shopCartAccordion" style="">
                        <!-- Form -->
                        <form class="js-validate p-5">
                            <!-- Title -->
                            <div class="mb-5">
                                <p class="text-gray-90 mb-2">Welcome back! Sign in to your account.</p>
                                <p class="text-gray-90">If you have shopped with us before, please enter your details below.
                                    If you are a new customer, please proceed to the Billing & Shipping section.</p>
                            </div>
                            <!-- End Title -->

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group">
                                        <label class="form-label" for="signinSrEmailExample3">Email address</label>
                                        <input type="email" class="form-control" name="email" id="signinSrEmailExample3"
                                            placeholder="Email address" aria-label="Email address" required
                                            data-msg="Please enter a valid email address." data-error-class="u-has-error"
                                            data-success-class="u-has-success">
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group">
                                        <label class="form-label" for="signinSrPasswordExample2">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            id="signinSrPasswordExample2" placeholder="********" aria-label="********"
                                            required data-msg="Your password is invalid. Please try again."
                                            data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>

                            <!-- Checkbox -->
                            <div class="js-form-message mb-3">
                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="rememberCheckbox"
                                        name="rememberCheckbox" required data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                    <label class="custom-control-label form-label" for="rememberCheckbox">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <!-- End Checkbox -->

                            <!-- Button -->
                            <div class="mb-1">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary px-5">Login</button>
                                </div>
                                <div class="mb-2">
                                    <a class="text-blue" href="#">Lost your password?</a>
                                </div>
                            </div>
                            <!-- End Button -->
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Accordion -->

            <!-- Accordion -->
            <div id="shopCartAccordion1" class="accordion rounded mb-6">
                <!-- Card -->
                <div class="card border-0">
                    <div id="shopCartHeadingTwo" class="alert alert-dark mb-0" role="alert">
                        Have a coupon? <a href="#" class="alert-link" data-toggle="collapse"
                            data-target="#shopCartTwo" aria-expanded="false" aria-controls="shopCartTwo">Click here to enter
                            your code</a>
                    </div>
                    <div id="shopCartTwo" class="collapse border border-top-0" aria-labelledby="shopCartHeadingTwo"
                        data-parent="#shopCartAccordion1" style="">

                        <p class="w-100 text-gray-90">If you have a coupon code, please apply it below.</p>
                        <div class="input-group input-group-pill max-width-660-xl">
                            <input type="text" class="form-control" name="name" placeholder="Coupon code"
                                aria-label="Promo code">
                            <div class="input-group-append">
                                <a href="javascript:void(0);" onclick="coupon()"
                                    class="btn btn-block btn-dark font-weight-normal btn-pill px-4">
                                    <i class="fas fa-tags d-md-none"></i>
                                    <span class="d-none d-md-inline">Apply coupon</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Accordion -->
            <form class="js-validate" novalidate="novalidate">
                <div class="row">
                    <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                        <div class="pl-lg-3 ">
                            <div class="bg-gray-1 rounded-lg">
                                <!-- Order Summary -->
                                <div class="p-4 mb-4 checkout-table">
                                    <!-- Title -->
                                    <div class="border-bottom border-color-1 mb-5">
                                        <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                                    </div>
                                    <!-- End Title -->

                                    <!-- Product Content -->
                                    <table class="table">

                                        <tbody>
                                            <tr class="cart_item">
                                                <td>{{ $product->product_name }}&nbsp;<strong class="product-quantity">×
                                                        {{ $qty }}</strong></td>
                                                <td>{{ number_format($product->discount_price != null ? $product->discount_price : $product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}
                                                </td>
                                            </tr>

                                        </tbody>
                                        <tfoot>

                                            <tr>
                                                <th>Subtotal</th>
                                                <td>{{ number_format($subtotal, 0, '.', ',') }}{{ $currency->symbol }}</td>
                                            </tr>
                                            <tr class="cart-discount d-none">
                                                <th>Discount <br>
                                                    <div id="couponList" class="row ml-10 ">
                                                    </div>
                                                </th>
                                                <td data-title="Discount"><span class="amount text-danger">00.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>Flat rate 00.00</td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td class="order-total" data-title="Total"><strong
                                                        class="amount  text-danger">{{ number_format($subtotal, 0, '.', ',') }}{{ $currency->symbol }}</strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- End Order Summary -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 order-lg-1">

                        <!-- Title -->
                        <div class="border-bottom border-color-1 mb-5">
                            <h3 class="section-title mb-0 pb-2 font-size-25">Billing details</h3>
                        </div>
                        <!-- End Title -->
                        <form id="billingForm"  method="POST" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="firstName">Full name</label>
                                    <input id="name" placeholder="full name" type="text" name="name" class="form-control"
                                        placeholder="" required>
                                    <div class="invalid-feedback">
                                        Valid customer name is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="mobile">Mobile</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+88</span>
                                    </div>
                                    <input id="phone" type="text" name="phone" class="form-control"
                                        placeholder="Mobile" required>
                                    <div class="invalid-feedback" style="width: 100%;">
                                        Your Mobile number is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                <input id="email" type="email" name="email" class="form-control"
                                    value="nhminhaz@gmail.com" required>
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address">Address</label>
                                <input id="address" type="text" class="form-control" name="address"
                                    placeholder="1234 Main St" required>
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="country">Divison</label>
                                    <select id="division_id" onclick="getDistrict()" class="custom-select d-block w-100"
                                        name="division_id" required>
                                        <option value="">Choose...</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">District</label>
                                    <select id="district_id" onclick="getState()" class="custom-select d-block w-100"
                                        name="district_id" required>
                                        <option value="">Choose...</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">State</label>
                                    <select id="state_id" class="custom-select d-block w-100" name="state_id" required>
                                        <option value="">Choose...</option>

                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                <div class="p-3" id="basicsHeadingThree">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="thirdstylishRadio1"
                                            name="stylishRadio">
                                        <label class="custom-control-label form-label" for="thirdstylishRadio1"
                                            data-toggle="collapse" data-target="#basicsCollapseThree"
                                            aria-expanded="false" aria-controls="basicsCollapseThree">
                                            Cash on delivery
                                        </label>
                                    </div>
                                </div>
                                <div id="basicsCollapseThree"
                                    class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                    aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion1">
                                    <div class="p-4">
                                        Pay with cash upon delivery.
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->

                            <!-- Card -->
                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                <div class="p-3" id="basicsHeadingThree">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="thirdstylishRadio4"
                                            name="stylishRadio">
                                        <label class="custom-control-label form-label" for="thirdstylishRadio4"
                                            data-toggle="collapse" data-target="#basicsCollapseThree4"
                                            aria-expanded="false" aria-controls="basicsCollapseThree4">
                                            Online Mobile Banking Payment
                                        </label>
                                    </div>
                                </div>
                                <div id="basicsCollapseThree4"
                                    class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                    aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion1">
                                    <div class="p-4">
                                        Pay with cash upon delivery.
                                    </div>
                                </div>
                            </div>
                            <!-- End Card -->
                            <hr class="mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">
                                <input type="hidden" value="1200" name="amount" id="total_amount" required />
                                <label class="custom-control-label" for="same-address">Shipping address is the same as my
                                    billing
                                    address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next
                                    time</label>
                            </div>
                            <hr class="mb-4">
                            <button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                token="if you have any token validation"
                                postdata="your javascript arrays or objects which requires in backend"
                                order="If you already have the transaction generated for current order"
                                endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
                            </button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </main>


    <script>
        function coupon() {
            var name = $("input[name='name']").val();
            $.ajax({
                type: "post",
                url: "{{ route('coupon.buy') }}",
                data: {
                    coupon: name
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message);
                    getBuyingCouponData();
                }
            });
        }

        function getBuyingCouponData() {

            $.ajax({
                type: "get",
                url: "{{ route('get-buy-coupon-data') }}",
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    let couponsHtml = '';
                    // Remove d-none class from cart-discount and cart-coupon

                    if (response.buyingCouponData && Object.keys(response.buyingCouponData).length > 0) {
                        $('.cart-discount').removeClass('d-none');

                        $('.cart-discount .amount').text("-" + response.buyingCouponData.discount
                            .toLocaleString('en-IN') +
                            response.currency.symbol);

                        $('.order-total .amount').text(response.buyingCouponData.total.toLocaleString('en-IN') +
                            response
                            .currency.symbol);

                        //Loop through individual coupons in couponsData
                        for (const couponName in response.buyingCouponData) {
                            if (couponName !== 'total' && couponName !== 'discount') {
                                const couponData = response.buyingCouponData[couponName];
                                console.log(couponName,
                                    couponData); // This will log each coupon data (e.g., abc, xyz, etc.)
                                couponsHtml += `<span class="coupon m-1 p-1 font-size-12"><i
                                                        class="fa-solid fa-tag fa-rotate-90"></i>
                                                    ${couponName} (${couponData.coupon_discount}%) 
                                                    <a href="javascript:void(0)" onclick="removeBuyingCoupon('${couponName}')" class="text-danger">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </a>
                                                </span>`

                            }
                        }

                        $('#couponList').html(couponsHtml);
                    } else {
                        subtotal = {{ $subtotal }};
                        $('.cart-discount').addClass('d-none');
                        $('.order-total .amount').text(subtotal.toLocaleString('en-IN') +
                            response
                            .currency.symbol);
                    }

                }
            });
        }

        function removeBuyingCoupon(coupon) {
            console.log(coupon);
            $.ajax({
                type: "post",
                url: "{{ route('remove-buying-coupon') }}",
                data: {
                    coupon: coupon
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    getBuyingCouponData();
                }
            });
        }

        $(document).ready(function() {
            getBuyingCouponData();
        });
    </script>



    <script>
        $('#sslczPayBtn').on('click', function() {

            var product = @json($product); // Convert the PHP variable to a JavaScript object
            var qty =@json ($qty)

            var obj = {};
            obj.product = product,
            obj.qty = qty,
            obj.name = $('#name').val();
            obj.phone = $('#phone').val();
            obj.email = $('#email').val();
            obj.address = $('#address').val();
            obj.division_id = $('#division_id').val();
            obj.district_id = $('#district_id').val();
            obj.state_id = $('#state_id').val();
            obj.route_name = "{{ Route::currentRouteName() }}"; // Get the current route name from Laravel
            console.log("obj : ", obj); 

            
                $('#sslczPayBtn').prop('postdata', obj);
           
            
        });

        (function(window, document) {
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(
                    7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);
    </script>

    {{-- <script>
          $(document).ready(function() {
        $('#billingForm').on('submit', function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            var isValid = true;

            // Check for empty fields
            $('input[type="text"], input[type="email"], select').each(function() {
                if ($(this).val() === '') {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            // If any field is empty, don't submit the form
            if (!isValid) {
                return false;
            } else {
                // If everything is valid, proceed with form submission
                var obj = {};
            obj.name = $('#name').val();
            obj.phone = $('#phone').val();
            obj.email = $('#email').val();
            obj.address = $('#address').val();
            obj.division_id = $('#division_id').val();
            obj.district_id = $('#district_id').val();
            obj.state_id = $('#state_id').val();
            console.log("obj : ", obj); 

            $('#sslczPayBtn').prop('postdata', obj);
            }
        });


        (function(window, document) {
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(
                    7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);
    });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            $('#billingForm').on('submit', function(event) {
                // Prevent the default form submission behavior
                event.preventDefault();
    
                var isValid = true;
    
                // Check for empty fields
                $('input[type="text"], input[type="email"], select').each(function() {
                    if ($(this).val() === '') {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });
    
                // If any field is empty, don't submit the form
                if (!isValid) {
                    return false;
                }
    
                // If everything is valid, proceed with form submission
                var obj = {
                    name: $('#name').val(),
                    phone: $('#phone').val(),
                    email: $('#email').val(),
                    address: $('#address').val(),
                    division_id: $('#division_id').val(),
                    district_id: $('#district_id').val(),
                    state_id: $('#state_id').val()
                };
    
                // Set the postdata attribute of the button
                $('#sslczPayBtn').prop('postdata', obj);
    
                // Trigger the payment process or further actions
                // ...
    
                // Manually trigger the form submission
                $(this).unbind('submit').submit();
            });
    
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };
    
            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        });
    </script> --}}


    <script>
        function getDistrict() {
            var selectedValue = $("select[name='division_id']").val();
            console.log(selectedValue);

            if (selectedValue != "") {
                $.ajax({
                    type: "GET",
                    url: "{{ route('get-district-fronted', ':id') }}".replace(':id', selectedValue),
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('select[name="district_id"]').empty();
                        $('select[name="state_id"]').empty();

                        $.each(response, function(key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });

                        getState();
                    },
                    error: function(error) {
                        console.log("Error:", error);
                    }
                });
            } else {
                $('select[name="district_id"]').empty();
                $('select[name="state_id"]').empty();
            }


        }



        function getState() {
            var selectedValue = $("select[name='district_id']").val();
            console.log(selectedValue);

            // Generate the URL using Laravel's route() function
            // Generate the URL using Laravel's route() function
            var url = "{{ route('get-state-fronted', ['id' => ':id']) }}";
            url = url.replace(':id', selectedValue);

            if (selectedValue != "") {
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $('select[name="state_id"]').empty();
                        $.each(response, function(key, value) {
                            $('select[name="state_id"]').append(
                                '<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    },
                    error: function(error) {
                        console.log("Error:", error);
                    }
                });
            }

        }
    </script>
@endsection
