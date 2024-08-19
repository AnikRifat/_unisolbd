@extends('frontend.main_master')
@section('title')
    Cart List Page
@endsection
@section('content')

@php
$route=Route::current()->getName();
@endphp

    <style>
        @media (max-width: 767.98px) {
            .cart-table .table tr td:not(:last-child)::before {
                content: attr(data-title) ": ";
            }

            .cart-table .table tr td:last-child::before {
                content: attr(data-title);
            }


        }

        .coupon {
            background-color: #dcdde1;
            border-radius: 50px;
        }

        /* Default Flexbox settings */
       
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <main id="content" role="main" class="cart-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><a href="{{ route("mycart") }}">Cart</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div id="emptyCart">

        </div>




        @if (count($carts) > 0)
            <div id="cartContainer" class="container">
                <div class="text-center">
                    <i class="ec ec-add-to-cart mr-1 font-size-64"></i>
                    <h2 class="text-center"><strong>My Cart</strong></h2>
                </div>
                <div class="mb-10 cart-table">
                    <form class="mb-4" action="#" method="post">
                        <table class="table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity w-lg-15">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody id="cartTbody">

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="6" class="border-top space-top-2 justify-content-center">
                                        <div class="pt-md-3">
                                            <div class="d-block d-md-flex flex-center-between">
                                                <div class="mb-3 mb-md-0 w-xl-40">
                                                    <!-- Apply coupon Form -->
                                                    <form class="js-focus-state">
                                                        <label class="sr-only" for="subscribeSrEmailExample1">Coupon
                                                            code</label>
                                                        <div class="input-group">
                                                            <input id="myCoupon" type="text" class="form-control"  name="coupon"
                                                                id="subscribeSrEmailExample1" placeholder="Coupon code"
                                                                aria-label="Coupon code"
                                                                aria-describedby="subscribeButtonExample2" required>
                                                            <div class="input-group-append">
                                                                <button onclick="applyCoupon()" class="btn btn-block btn-dark px-4" type="button"
                                                                    id="subscribeButtonExample2"><i
                                                                        class="fas fa-tags d-md-none"></i><span
                                                                        class="d-none d-md-inline">Apply
                                                                        coupon</span></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- End Apply coupon Form -->
                                                </div>
                                                <div class="d-md-flex">
                                                    <button type="button"
                                                        class="btn btn-soft-secondary mb-3 mb-md-0 font-weight-normal px-5 px-md-4 px-lg-5 w-100 w-md-auto">Update
                                                        cart</button>
                                                    <a href="{{ route('checkout') }}"
                                                        class="btn btn-primary ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-none d-md-inline-block">Proceed
                                                        to checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
                <div class="mb-8 cart-total">
                    <div class="row">
                        <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7 col-md-8 offset-md-4">
                            <div class="border-bottom border-color-1 mb-3">
                                <h3 class="d-inline-block section-title mb-0 pb-2 font-size-26">Cart totals</h3>
                            </div>
                            <table class="table mb-3 mb-md-0">
                                <tbody>
                                    <tr class="cart-subtotal ">
                                        <th>Subtotal</th>
                                        <td data-title="Subtotal"><span class="amount text-danger">00.00</span></td>
                                    </tr>
                                    <tr class="cart-discount d-none">
                                        <th>Discount</th>
                                        <td data-title="Discount"><span class="amount text-danger">00.00</span></td>
                                    </tr>
                                    <tr class="cart-coupon d-none">
                                        <td class="p-0" style="width: 15px;"></td>
                                        <td colspan="1" class="float-left py-0">
                                            <div id="couponList" class="row">
                                                <span class="coupon m-1 p-1 font-size-12"><i
                                                        class="fa-solid fa-tag fa-rotate-90"></i>
                                                    coupon
                                                    <a href="" class="text-danger">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </a>
                                                </span>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr class="shipping">
                                        <th>Shipping</th>
                                        <td data-title="Shipping">
                                            Flat Rate: <span class="amount  text-danger">00.00</span>

                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td data-title="Total"><strong><span
                                                    class="amount  text-danger">00.00</span></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{ route('checkout') }}"
                                class="btn btn-primary ml-md-2 px-5 px-md-4 px-lg-5 w-100 w-md-auto d-md-none">Proceed
                                to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif


    </main>


    <script>
        $(document).ready(function() {
            // Attach event listener to parent element '#cartTbody' for '.js-plus' and '.js-minus' buttons
            $('#cartTbody').on('click', '.js-plus, .js-minus', function() {
                var rowId = $(this).data('row-id');
                var quantityInput = $('.cart-qty-input[data-row-id="' + rowId + '"]');
                var currentQuantity = parseInt(quantityInput.val() || '0'); // Convert null to 0

                if ($(this).hasClass('js-plus')) {
                    // Increment the quantity by 1
                    var newQuantity = currentQuantity + 1;
                } else {
                    // Decrement the quantity by 1, but ensure it doesn't go below 1
                    var newQuantity = Math.max(currentQuantity - 1, 1);
                }

                // Update the input value
                quantityInput.val(newQuantity);

                cartQtyIncreaseDecrease(rowId, newQuantity); // Pass newQuantity as an integer
            });

            // Attach event listener to parent element '#cartTbody' for '.cart-qty-input' input fields
            $('#cartTbody').on('input', '.cart-qty-input', function() {
                var currentQuantity = parseInt($(this).val() || '1'); // Convert null to 1
                // Ensure the value is not 0 and not null
                if (currentQuantity === 0 || isNaN(currentQuantity)) {
                    $(this).val('1'); // Set to 1 if invalid input
                }
            });

            // Attach event listener to parent element '#cartTbody' for '.cart-qty-input' input fields
            $('#cartTbody').on('focusout', '.cart-qty-input', function() {
                var currentQuantity = parseInt($(this).val() || '1'); // Convert null to 1
                $(this).val(currentQuantity);
            });
        });
    </script>


    <script>
        function cartQtyIncreaseDecrease(rowId, qty) {
            console.log(rowId + "        " + qty);
            $.ajax({
                type: "post",
                url: "{{ route('cart-qty-increase-decrease') }}",
                data: {
                    rowId: rowId,
                    qty: qty
                },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    getCartData();
                }
            });
        }
    </script>


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
@endsection
