@extends('frontend.main_master')

@section('title')
    Wist List Page
@endsection

@section('content')
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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><a href="{{ route("wishlist") }}">Wishlist</a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div id="emptyWishlist" class="{{ count($wishlists)>0? "d-none":"" }}">
            <div class="container mt-4 mb-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body cart">
                                <div class="col-sm-12 empty-cart-cls text-center">
                                    <img src="{{ asset('frontend/assets/img/wishlist.png') }}" width="130" height="130"
                                        class="img-fluid mb-4 mr-3">
                                    <h3><strong>Wishlist</strong></h3>
                                    <p class="mb-2 font-size-16">Opps, there are no products in wishlist, go find the
                                        products you like!</p>
                                    <a href="{{ route('home') }}" class="btn btn-primary cart-btn-transform"
                                        data-abc="true">go
                                        shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="wishlistContainer" class="container {{ count($wishlists)==0? "d-none":"" }}">
            <div class="text-center">
                <i class="ec ec-favorites mr-1 font-size-64"></i>

                <h3 class="text-center"><strong>My Wishlist on t3solution</strong></h3>
            </div>
            <div class="mb-16 wishlist-table">
                <form class="mb-4" action="#" method="post">
                    <div class="table-responsive">
                        <table class="table" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="product-remove">&nbsp;</th>
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Unit Price</th>
                                    <th class="product-Stock">Stock Status</th>
                                    <th class="product-subtotal min-width-200-md-lg">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="wishlistBody">

                                @foreach ($wishlists as $wishlist)
                                    <tr>
                                        <td class="text-center">
                                            <a data-wishlist="{{ base64_encode($wishlist->id) }}"
                                                onclick="removeWishlist(this)" href="javascript:void(0)"
                                                class="text-gray-32 font-size-26">×</a>
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <a href="#"><img class="img-fluid max-width-100 p-1 border border-color-1"
                                                    src="{{ $wishlist->product->product_thambnail }}"
                                                    alt="Image Description"></a>
                                        </td>

                                        <td data-title="Product">
                                            <a href="#"
                                                class="text-gray-90">{{ $wishlist->product->product_name }}</a>
                                        </td>

                                        <td class="w-auto" data-title="Unit Price">
                                            <span class="text-danger">
                                                {{ number_format($wishlist->product->discount_price != null ? $wishlist->product->discount_price : $wishlist->product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</span>
                                        </td>

                                        <td data-title="Stock Status">
                                            <!-- Stock Status -->
                                            <span class="text-success">In stock</span>
                                            <!-- End Stock Status -->
                                        </td>

                                        <td class="w-md-15 w-auto">
                                            <a href="javascript:void(0)" onclick="addToCart(this)"
                                                data-product-id="{{ base64_encode($wishlist->product->id) }}" type="button"
                                                class="btn  btn-primary mb-3 mb-md-0 font-weight-normal  w-100 w-md-10">Add
                                                to Cart</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </main>


    <script>
        function removeWishlist(element) {
            var encodedProductId = $(element).data('wishlist');
            var decodedProductId = atob(encodedProductId);

            console.log('Encoded Product ID:', encodedProductId);
            console.log('Decoded Product ID:', decodedProductId);

            $.ajax({
                type: "post",
                url: "{{ route('remove-wishlist') }}",
                data: {
                    id: decodedProductId
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    showToastr(response.type, response.message);
                    $(element).closest('tr').remove();
                    if ($("#wishlistBody tr").length === 0) {
                        $("#wishlistContainer").addClass('d-none');
                        $("#emptyWishlist").removeClass('d-none');
                    }
                }
            });


        }
    </script>
@endsection
