@extends('frontend.main_master')

@section('title')
    Checkout List Page
@endsection

@section('content')

@php
$route=Route::current()->getName();
@endphp


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

    {{-- <!-- Page Header Start -->
    <div class="container-fluid bg-secondary">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 100px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 mx-md-5">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <form method="POST" action="{{ route('stripe.order')}}">
                            @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input  class="form-control" value="{{ Auth::user()->name }}" name="name"  type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" value="{{ Auth::user()->email }}" name="email" type="email"  readonly>
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input class="form-control" value="{{ Auth::user()->phone }}" name="phone" type="text" readonly>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" name="address" type="text" required > </textarea>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-7">
                <div class="card border-secondary">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-1">
                            <div class="table-responsive">
                                <table class="table text-center mb-0">
                                    <thead class="bg-secondary text-dark">
                                        <tr>
                                            <th>Products</th>
                                            <th>Quantity</th>
                                            <th>Color</th>
                                            <th>Size</th>
                                            <th>SubTotal</th>
                                        </tr>
                                    </thead>
                                    @foreach ($carts as $item)
                                        <tr>
                                            <td class="align-middle"><img src="{{ asset($item->options->image) }}"
                                                    alt="" style="width: 40px;"></td>
                                            <td class="align-middle">{{ $item->qty }}</td>
                                            <td class="align-middle">{{ $item->options->color }}</td>
                                            <td class="align-middle">{{ $item->options->size }}</td>
                                            <td class="align-middle text-danger"><strong>{{$currency->symbol}}. {{ $item->subtotal }}</strong></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex mt-2 float-right">
                            <strong class="mr-3"><h5 class="font-weight-bold">Total : </h5></strong>
                            <strong class="text-danger">{{ $currency->symbol }}. {{ $cartTotal }}</strong>
                        </div>

                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>
    <!-- Checkout End --> --}}


    <main id="content" role="main" class="checkout-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="../home/index.html">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Checkout</li>
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
                        Returning customer? <a href="#" class="alert-link" data-toggle="collapse" data-target="#shopCartOne" aria-expanded="false" aria-controls="shopCartOne">Click here to login</a>
                    </div>
                    <div id="shopCartOne" class="collapse border border-top-0" aria-labelledby="shopCartHeadingOne" data-parent="#shopCartAccordion" style="">
                        <!-- Form -->
                        <form class="js-validate p-5">
                            <!-- Title -->
                            <div class="mb-5">
                                <p class="text-gray-90 mb-2">Welcome back! Sign in to your account.</p>
                                <p class="text-gray-90">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing & Shipping section.</p>
                            </div>
                            <!-- End Title -->

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group">
                                        <label class="form-label" for="signinSrEmailExample3">Email address</label>
                                        <input type="email" class="form-control" name="email" id="signinSrEmailExample3" placeholder="Email address" aria-label="Email address" required
                                        data-msg="Please enter a valid email address."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                                <div class="col-lg-6">
                                    <!-- Form Group -->
                                    <div class="js-form-message form-group">
                                        <label class="form-label" for="signinSrPasswordExample2">Password</label>
                                        <input type="password" class="form-control" name="password" id="signinSrPasswordExample2" placeholder="********" aria-label="********" required
                                        data-msg="Your password is invalid. Please try again."
                                        data-error-class="u-has-error"
                                        data-success-class="u-has-success">
                                    </div>
                                    <!-- End Form Group -->
                                </div>
                            </div>

                            <!-- Checkbox -->
                            <div class="js-form-message mb-3">
                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                    <input type="checkbox" class="custom-control-input" id="rememberCheckbox" name="rememberCheckbox" required
                                    data-error-class="u-has-error"
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
                        Have a coupon? <a href="#" class="alert-link" data-toggle="collapse" data-target="#shopCartTwo" aria-expanded="false" aria-controls="shopCartTwo">Click here to enter your code</a>
                    </div>
                    <div id="shopCartTwo" class="collapse border border-top-0" aria-labelledby="shopCartHeadingTwo" data-parent="#shopCartAccordion1" style="">
                       
                            <p class="w-100 text-gray-90">If you have a coupon code, please apply it below.</p>
                            <div class="input-group input-group-pill max-width-660-xl">
                                <input id="myCoupon" name="coupon" type="text" class="form-control" name="name" placeholder="Coupon code" aria-label="Promo code">
                                <div class="input-group-append">
                                    <button onclick="applyCoupon()" type="submit" class="btn btn-block btn-dark font-weight-normal btn-pill px-4">
                                        <i class="fas fa-tags d-md-none"></i>
                                        <span class="d-none d-md-inline">Apply coupon</span>
                                    </button>
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
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cartItem">


                                            @foreach ($carts as $product)
                                            <tr class="cart_item">
                                                <td>{{ $product->name }}&nbsp;<strong class="product-quantity">× {{ $product->qty }}</strong></td>
                                                <td>{{ number_format($product->subtotal, 0, '.', ',') }}{{ $currency->symbol }}</td>
                                            </tr>
                                            @endforeach
                                           
                                           


                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Subtotal</th>
                                                <td>{{ number_format($cartTotal, 0, '.', ',') }}{{ $currency->symbol }}</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping</th>
                                                <td>Flat rate 00.00</td>
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
                                                <th>Total</th>
                                                <td class="order-total" data-title="Total"><strong
                                                        class="amount  text-danger">{{ number_format($cartTotal, 0, '.', ',') }}{{ $currency->symbol }}</strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!-- End Product Content -->
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
         function applyCoupon()
        {
            coupon = $('#myCoupon').val().trim();
            console.log(coupon);
            $.ajax({
                type: "post",
                url: "{{ route('apply-coupon') }}",
                data: {coupon:coupon},
                dataType: "json",
                success: function (response) {
                    console.log(response);
                    showToastr(response.type, response.message);
                    getCartData();
                }
            });
        }
    </script>



<script>
    $('#sslczPayBtn').on('click', function() {

        

        var obj = {};
        
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
