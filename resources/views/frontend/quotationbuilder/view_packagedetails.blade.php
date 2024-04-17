@extends('frontend.main_master')
@section('content')
    <style>
        .js-result {
            width: 10px;
        }

        .title {
            background: linear-gradient(318deg, rgba(82,195,255,1) 36%, rgba(88,104,162,1) 75%);;
        }

        .heading {
            color: #5868a2;
        }

        .footer-top-widget {
            display: none
        }
    </style>
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="cart-page">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="m-0 p-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb  flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1" aria-current="page"><a
                                href="{{ route('view.package') }}">Quotation Builder</a>
                            </li>
                            @if (count($packageDetails) > 0)
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">
                                <a
                                href="{{ route('view.packageDetails',(encrypt($packageDetails->first()->package->id)))  }}">{{ $packageDetails->first()->package->name }}</a>
                            </li>
                            @endif
                                
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->
        <div class="container">
            {{-- {{ Session::get($packageDetails->first()->package->name)['Processor']}} --}}
            {{-- @if (Session::has($packageDetails->first()->package->name))
      <h1>
         {{ Session::get($packageDetails->first()->package->name)['SSD']}}
      </h1>
      @endif --}}
            <div class="row justify-content-center align-items-center">
                @if (count($packageDetails) > 0)
                    <div class="col-lg-10 mb-10">
                        <div class="d-flex d-flex justify-content-between align-items-center">
                            <div class="d-lg-block d-none d-flex justify-content-center align-items-center">
                                <span class="font-size-16 bg-dark rounded rounded-lg  p-2 text-center text-white">Total :
                                    <span
                                        id="txtTotal">{{ Session::has($packageDetails->first()->package->name) ? number_format(Session::get($packageDetails->first()->package->name)['total_price'] , 0, '.', ','): 0 }}</span><span
                                        
                                        class="font-size-22">{{ $currency->symbol }}</span></span>

                                        @if (Session::has($packageDetails->first()->package->name))
                                            @php
                                                $totalPrice = Session::get($packageDetails->first()->package->name)['total_price'];
                                            @endphp

                                            @if ($totalPrice > 0)
                                            <a href="{{ route('frontend.create.package',encrypt($packageDetails->first()->package->id)) }}"  class="ml-2 btn btn-soft-dark border border-dark ">NEXT</a>
                                            @endif
                                        @endif

                                        
							
                                {{-- {{ Session::get($packageDetails->first()->package->name)['total_price'] }} --}}
                            </div>
                            <div class="center-text-side">
                                <h4 class="fw-bold mb-0" style="color: rgba(238,34,82,1)">
                                    {{ $packageDetails->first()->package->name }}
                                </h4>
                                <p class="mb-1 text-center">Select Your Components</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 p-0">
                                <h5 class="title bg-success text-white mb-0 p-2">
                                    Items for {{ $packageDetails->first()->package->name }}
                                </h5>
                            </div>
                        </div>
                        @foreach ($packageDetails as $index => $item)
                            @php
                                $dynamicKey = $item->subsubcategory ? $item->subsubcategory->subsubcategory_name : ($item->subcategory ? $item->subcategory->subcategory_name : $item->category->category_name);
                            @endphp
                            @isset(session($packageDetails->first()->package->name)[$dynamicKey])
                                <div class="row align-items-center border border-gray-18 border-top-0  p-3">
                                    <div class="col-md-1 col-2 ps-4">
                                        <div class="d-flex align-items-center">
                                            {{-- <i class="fa fa-microchip fa-3x text-dark"></i> --}}
                                            <img src="{{ asset(Session::get($packageDetails->first()->package->name)[$dynamicKey]['product_thambnail']) }}"
                                                alt="" style="height:40px; width:40px">
                                        </div>
                                    </div>
                                    <div class="col-md-11 col-10">
                                        <div class="ms-2">
                                            <div
                                                class="d-flex align-items-center justify-content-between font-size-16 font-weight-bold">
                                              
                                                {{ $dynamicKey }}
                                            </div>
                                            <div class="mt-1"><a href="#"
                                                    class="text-gray-90">{{ Session::get($packageDetails->first()->package->name)[$dynamicKey]['product_name'] }}
                                                </a>
                                            </div>
                                            <div
                                                class="quotation-builder row d-flex align-items-center justify-content-md-end mt-1">
                                                <div
                                                    class="border rounded-pill justify-content-start ml-2 ml-md-0 mt-2 mt-md-0   border-color-1 col-md-3 col-lg-2">
                                                    <div class="js-quantity row align-items-center">
                                                        <div class="col">
                                                            <input id="qty{{ $index }}"
                                                                data-qutation="{{ encrypt($packageDetails->first()->package->name) }}"
                                                                data-key="{{ encrypt($dynamicKey) }}"
                                                                class="qty form-control h-auto border-0 rounded p-0 shadow-none"
                                                                type="text" value="{{Session::get($packageDetails->first()->package->name)[$dynamicKey]['qty']  }}">
                                                        </div>
                                                        <div class="col-auto pr-1">
                                                            <a data-action="decrease"
                                                                data-qutation="{{ encrypt($packageDetails->first()->package->name) }}"
                                                                data-key="{{ encrypt($dynamicKey) }}"
                                                                class="js-change-quantity js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                                href="javascript:;">
                                                                <small class="fas fa-minus btn-icon__inner"></small>
                                                            </a>
                                                            <a data-action="increase"
                                                                data-qutation="{{ encrypt($packageDetails->first()->package->name) }}"
                                                                data-key="{{ encrypt($dynamicKey) }}"
                                                                class="js-change-quantity js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0"
                                                                href="javascript:;">
                                                                <small class="fas fa-plus btn-icon__inner"></small>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2  mt-2 mt-md-0">
                                                    <span>
                                                        {{ number_format(Session::get($packageDetails->first()->package->name)[$dynamicKey]['discount_price'] != null ? Session::get($packageDetails->first()->package->name)[$dynamicKey]['discount_price'] : Session::get($packageDetails->first()->package->name)[$dynamicKey]['selling_price'], 0, '.', ',') }}<span
                                                            class="font-size-18">{{ $currency->symbol }}</span></span>
                                                </div>
                                                <div
                                                    class="col-md-3  mt-2 mt-md-0 d-flex justify-content-between justify-content-md-around">
                                                    <span><span
                                                            class="subtotal">{{number_format(Session::get($packageDetails->first()->package->name)[$dynamicKey]['subTotal'], 0, '.', ',')   }}</span><span
                                                            class="font-size-18">{{ $currency->symbol }}</span></span>
                                                    <a data-qutation="{{ encrypt($packageDetails->first()->package->name) }}"
                                                        data-key="{{ encrypt($dynamicKey) }}"
                                                        data-package_id="{{ encrypt($packageDetails->first()->package->id) }}"
                                                        onclick="removePackageProduct(this)" href="javaScript:void(0)"
                                                        class="btn btn-sm  p-0"><i class="fas fa-times"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row align-items-center border border-gray-18 border-top-0  p-3">
                                    <div class="col-md-1 col-2 ps-4">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-microchip fa-3x text-dark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-11 col-10">
                                        <div class="ms-2">
                                            <form action="{{ route('view.packageDetailsProducts') }}" method="get">
                                                @csrf
                                                <div class="d-flex align-items-center justify-content-between">


                                                    <button type="submit" class="text-gray-90"
                                                        style="border: none; background-color: transparent; cursor: pointer;">
                                                        @if ($item->subcategory != null)
                                                            @if ($item->subsubcategory != null)
                                                                {{ $item['subsubcategory']['subsubcategory_name'] }}
                                                            @else
                                                                {{ $item['subcategory']['subcategory_name'] }}
                                                            @endif
                                                        @else
                                                            {{ $item['category']['category_name'] }}
                                                        @endif
                                                    </button>


                                                    <div>
                                                        <form action="{{ route('view.packageDetailsProducts') }}"
                                                            method="get">
                                                            @csrf
                                                            <input type="hidden" name="quotation_builder"
                                                                value="{{ $packageDetails->first()->package->id }}">
                                                            @if ($item->subcategory != null)
                                                                @if ($item->subsubcategory != null)
                                                                    <input type="hidden" name="name"
                                                                        value="{{ $item['subsubcategory']['subsubcategory_name'] }}">
                                                                    <input type="hidden" name="subsubcategory_id"
                                                                        value="{{ $item->subsubcategory_id }}">
                                                                @else
                                                                    <input type="hidden" name="name"
                                                                        value="{{ $item['subcategory']['subcategory_name'] }}">
                                                                    <input type="hidden" name="subcategory_id"
                                                                        value="{{ $item->subcategory_id }}">
                                                                @endif
                                                            @else
                                                                <input type="hidden" name="name"
                                                                    value="{{ $item['category']['category_name'] }}">
                                                                <input type="hidden" name="category_id"
                                                                    value="{{ $item->category_id }}">
                                                            @endif
                                                            <button type="submit"
                                                                class="btn btn-soft-secondary border border-secondary  font-weight-normal">Choose</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        @endforeach
                    </div>
                @else
                    <h3 class="text-center text-danger">No items found in this package</h3>
                @endif
            </div>
        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
    <script>
        $(document).ready(function() {
            $("#footer-top-widget").removeClass("d-lg-block");
        });
    </script>


    <script>
        $(document).ready(function() {
            $(document).on("click", ".js-change-quantity", function(event) {
                event.preventDefault();

                const action = $(this).data("action");
                const container = $(this).closest(".js-quantity");
                const input = container.find(".qty");

                let value = parseInt(input.val());
                value = isNaN(value) ? 0 : value;

                if (action === "decrease" && value > 1) {
                    input.val(value - 1);
                    increaseDecreaseQuotationQty(input.val(), $(this).data("qutation"), $(this).data(
                        "key"));
                } else if (action === "increase") {
                    input.val(value + 1);
                    increaseDecreaseQuotationQty(input.val(), $(this).data("qutation"), $(this).data(
                        "key"));
                }
            });

            $(document).on("focusout", ".qty", function() {
                let value = parseInt($(this).val());
                // If the value is null or NaN, set to 1
                value = isNaN(value) ? 1 : value;
                // If the value is less than or equal to 0, set to 1
                if (value <= 0) {
                    value = 1;
                }
                $(this).val(value);

                const qutation = $(this).data("qutation");
                const key = $(this).data("key");

                // console.log("Value after focusout: " + value);
                // console.log("Qutation: " + qutation);
                // console.log("Key: " + key);

                increaseDecreaseQuotationQty(value, qutation, key);
            });


            $(document).on("keydown", ".qty", function(e) {
                // Allow only numbers and navigation keys
                if (!(e.key === "ArrowUp" || e.key === "ArrowDown" || e.key === "Backspace" ||
                        e.key === "Delete" || e.key === "Tab" || e.key === "Enter" ||
                        (e.key >= "0" && e.key <= "9"))) {
                    e.preventDefault();
                }
            });
        });

        function increaseDecreaseQuotationQty(quantity, quotation, key) {
            // console.log("Quantity:", quantity);
            // console.log("Quotation:", quotation);
            // console.log("Key:", key);

            $.ajax({
                type: "get",
                url: "{{ route('increase-decrease-package-qty') }}",
                data: {
                    quotation: quotation,
                    key: key,
                    qty: quantity
                },
                dataType: "json",
                success: function(response) {
                    // Update the subtotal and total on the page
                    const container = $('[data-qutation="' + quotation + '"][data-key="' + key +
                        '"]').closest(".quotation-builder");
                    container.find(".subtotal").text(response.subTotal.toLocaleString());
                    $('#txtTotal').text(response.total.toLocaleString());
                    // console.log(response);
                    // console.log(response)
                }
            });
        }
    </script>


    {{-- <script>
        $(document).ready(function() {
            $(document).on("click", ".js-change-quantity", function(event) {
                event.preventDefault();

                const action = $(this).data("action");
                const container = $(this).closest(".js-quantity");
                const input = container.find(".qty");

                let value = parseInt(input.val());
                value = isNaN(value) ? 0 : value;

                if (action === "decrease" && value > 1) {
                    input.val(value - 1);
                    increaseDecreaseQuotationQty(input.val(), $(this).data("qutation"), $(this).data(
                        "key"));
                } else if (action === "increase") {
                    input.val(value + 1);
                    increaseDecreaseQuotationQty(input.val(), $(this).data("qutation"), $(this).data(
                        "key"));
                }
            });

            function increaseDecreaseQuotationQty(quantity, quotation, key) {
                // console.log("Quantity:", quantity);
                // console.log("Quotation:", quotation);
                // console.log("Key:", key);

                $.ajax({
                    type: "get",
                    url: "{{ route('increase-decrease-package-qty') }}",
                    data: {
                        quotation: quotation,
                        key: key,
                        qty: quantity
                    },
                    dataType: "json",
                    success: function(response) {
                        // Update the subtotal and total on the page
                        const container = $('[data-qutation="' + quotation + '"][data-key="' + key +
                            '"]').closest(".quotation-builder");
                        container.find(".subtotal").text(response.subTotal);
                        $('#txtTotal').text(response.total);
                        // console.log(response);
                        // console.log(response)
                    }
                });
            }
        });
    </script> --}}
    <script>
        function removePackageProduct(element) {
            const qutation = $(element).data("qutation");
            const key = $(element).data("key");
            const package_id = $(element).data("package_id"); // Add this line

            // Now you can use qutation and key in your logic
            // console.log("Quotation:", qutation);
            // console.log("Key:", key);

            $.ajax({
                type: "post",
                url: "{{ route('remove-package-product') }}",
                data: {
                    package_id: package_id,
                    qutation: qutation,
                    key: key,
                },
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    const extractedContent = response.extractedContent;

                    if (extractedContent !== undefined) {
                        // Update the content of the main element
                        $('main.cart-page').html(extractedContent);
                    } else {
                        console.log("Extracted content is undefined.");
                    }

                }
            });
        }
    </script>
@endsection
