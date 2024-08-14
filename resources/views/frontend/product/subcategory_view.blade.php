@extends('frontend.main_master')
@section('title')
    Sub Category Product
@endsection
@section('content')
    <script src="{{ asset('frontendassets/custom-js/pagination.js') }}"></script>
    <!-- Include jQuery -->

    <!-- Include twbsPagination -->


    <script>
        var currencySymbol = "{!! $currency->symbol !!}";
    </script>




    <main id="content" role="main">


        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('/') }}"><i class="fa fa-home"></i></a>

                            </li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{ url('category/product/'.$SubCategoryWiseProducts->first()->category->category_slug.'/'.encrypt($SubCategoryWiseProducts->first()->category->id)) }}">{{ $SubCategoryWiseProducts->first()->category->category_name }}</a>

                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><a
                                    href="{{ url('subcategory/product/'.$SubCategoryWiseProducts->first()->subcategory->subcategory_slug.'/'.encrypt($SubCategoryWiseProducts->first()->subcategory->id)) }}">{{ $SubCategoryWiseProducts->first()->subcategory->subcategory_name }}</a>

                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container">

            <div class="row mb-8">
                <div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
                    <div class="mb-2">
                        <div class="border-bottom border-color-1 mb-2">
                            <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Filters</h3>
                        </div>

                        <div class="border-bottom pb-2 mb-2">
                            <h4 class="font-size-14 mb-3 font-weight-bold">Brands</h4>

                            {{-- @php
                                $brandCounts = $SubCategoryWiseProducts->groupBy('brand_id')->map(function ($products, $brandId) {
                                    $brand = \App\Models\Brand::find($brandId); // Assuming you have a Brand model
                                    return [
                                        'id' => $brandId,
                                        'name' => $brand->brand_name,
                                        'count' => $products->count(),
                                    ];
                                });
                            @endphp --}}

                            @php
                                $brandCounts = $SubCategoryWiseProducts
                                    ->groupBy('brand_id')
                                    ->map(function ($products, $brandId) {
                                        $brand = \App\Models\Brand::find($brandId);

                                        // Check if the brand is found
                                        if ($brand) {
                                            return [
                                                'id' => $brandId,
                                                'name' => $brand->brand_name,
                                                'count' => $products->count(),
                                            ];
                                        } else {
                                            return null; // Skip this brand
                                        }
                                    })
                                    ->filter(); // Filter out null values
                            @endphp




                            @foreach ($brandCounts as $brand)
                                @if ($loop->index < 3)
                                    <div
                                        class="filter-with-brand form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input value="{{ $brand['id'] }}" type="checkbox"
                                                class="brand_filter custom-control-input" id="brand{{ $brand['id'] }}">
                                            <label class="custom-control-label" for="brand{{ $brand['id'] }}">
                                                {{ $brand['name'] }} ({{ $brand['count'] }})
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    @if ($loop->index === 3)
                                        <!-- View More - Collapse -->
                                        <div class="collapse" id="collapseBrand">
                                    @endif

                                    <div
                                        class="filter-with-brand form-group d-flex align-items-center justify-content-between mb-2 pb-1">
                                        <div class="custom-control custom-checkbox">
                                            <input value="{{ $brand['id'] }}" type="checkbox"
                                                class="brand_filter custom-control-input" id="brand{{ $brand['id'] }}">
                                            <label class="custom-control-label" for="brand{{ $brand['id'] }}">
                                                {{ $brand['name'] }} ({{ $brand['count'] }})
                                            </label>
                                        </div>
                                    </div>

                                    @if ($loop->last)
                        </div>
                        <!-- End View More - Collapse -->

                        <!-- Link -->
                        <a class="link link-collapse small font-size-13 text-gray-27 d-inline-flex mt-2"
                            data-toggle="collapse" href="#collapseBrand" role="button" aria-expanded="false"
                            aria-controls="collapseBrand">
                            <span class="link__icon text-gray-27 bg-white">
                                <span class="link__icon-inner">+</span>
                            </span>
                            <span class="link-collapse__default">Show more</span>
                            <span class="link-collapse__active">Show less</span>
                        </a>
                        <!-- End Link -->
                        @endif
                        @endif
                        @endforeach
                    </div>
                </div>
                {{-- <div class="mb-8">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Latest Products</h3>
                    </div>
                    <ul class="list-unstyled" id="jar">
                        @forelse ($latest_products as $product)
                            <li class="mb-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}"
                                            class="d-block width-75">
                                            <img class="img-fluid" src="{{ asset($product->product_thambnail) }}"
                                                alt="Image Description">
                                        </a>
                                    </div>
                                    <div class="col">
                                        <h3 class="text-lh-1dot2 font-size-14 mb-0"><a
                                                href="{{ url('/product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                        </h3>

                                        <div class="font-weight-bold">
                                            @if ($product->discount_price != null)
                                                <del
                                                    class="font-size-11 text-gray-9 d-block">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</del>
                                                <ins
                                                    class="font-size-15 text-red text-decoration-none d-block">{{ number_format($product->discount_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                        @endforelse

                    </ul>
                </div> --}}
                <div class="mb-8">
                    <div class="border-bottom border-color-1 mb-5">
                        <h3 class="section-title section-title__sm mb-0 pb-2 font-size-18">Latest Products</h3>
                    </div>
                    <ul class="list-unstyled">
                        @foreach($latest_products as $product)
                        <li class="mb-4">
                            <div class="row">
                                <div class="col-auto">
                                    <a href="{{ url('/product/details/' .$product->product_slug. '/' .encrypt($product->id)) }}" class="d-block width-75">
                                        <img class="img-fluid" src="{{ asset($product->product_thambnail) }}" alt="Image Description">
                                    </a>
                                </div>
                                <div class="col">
                                    <h3 class="text-lh-1dot2 font-size-14 mb-0"><a href="{{ url('/product/details/' .$product->product_slug. '/' .encrypt($product->id)) }}">{{ $product->product_name }}</a></h3>
                                    {{-- <div class="text-warning text-ls-n2 font-size-16 mb-1" style="width: 80px;">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="far fa-star text-muted"></small>
                                    </div> --}}
                                    @auth
                                    <div class="font-weight-bold">
                                        {{-- <del class="font-size-11 text-gray-9 d-block">{{$product->discount_price != null ? $prouduct->selling_price  $currency->symbol:""}}</del>
                                    <ins class="font-size-15 text-red text-decoration-none d-block">{{$product->discount_price != null ? $prouduct->discount_price:$product->selling_price}}{{ $currency->symbol }}</ins> --}}
                                        <del class="font-size-11 text-gray-9 d-block">
                                            {{ $product->discount_price != null ? $product->selling_price . $currency->symbol : '' }}
                                        </del>
                                        <ins class="font-size-15 text-red text-decoration-none d-block">
                                            {{ $product->discount_price != null ? $product->discount_price : $product->selling_price }}{{ $currency->symbol }}
                                        </ins>

                                    </div>
                                    @endauth
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-wd-9gdot5">

                <!-- Shop-control-bar -->
                <div class="bg-gray-1 flex-center-between borders-radius-9 py-1">
                    <div class="d-xl-none">
                        <!-- Account Sidebar Toggle Button -->
                        <a id="sidebarNavToggler1" class="btn btn-sm py-1 font-weight-normal" href="javascript:;"
                            role="button" aria-controls="sidebarContent1" aria-haspopup="true" aria-expanded="false"
                            data-unfold-event="click" data-unfold-hide-on-scroll="false"
                            data-unfold-target="#sidebarContent1" data-unfold-type="css-animation"
                            data-unfold-animation-in="fadeInLeft" data-unfold-animation-out="fadeOutLeft"
                            data-unfold-duration="500">
                            <i class="fas fa-sliders-h"></i> <span class="ml-1">Filters</span>
                        </a>
                        <!-- End Account Sidebar Toggle Button -->
                    </div>
                    <div class="px-3 d-none d-xl-block">
                        <h4>{{ $SubCategoryWiseProducts->first()->subcategory->subcategory_name }}</h4>
                    </div>
                    <div class="d-flex">
                        <form method="get">
                            <!-- Select -->
                            <select id="sort-select"
                                class="js-select selectpicker dropdown-select max-width-200 max-width-160-sm right-dropdown-0 px-2 px-xl-0"
                                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option value="default" selected>Default sorting</option>
                                <option value="low-to-high">Sort by price: low to high</option>
                                <option value="high-to-low">Sort by price: high to low</option>
                            </select>

                            <!-- End Select -->
                        </form>
                        <form method="POST" class="ml-2 d-none d-xl-block">
                            <!-- Select -->
                            <select id="productPerPage" class="js-select selectpicker dropdown-select max-width-100"
                                data-style="btn-sm bg-white font-weight-normal py-2 border text-gray-20 bg-lg-down-transparent border-lg-down-0">
                                <option value="20" selected>20</option>
                                <option value="24">24</option>
                                <option value="44">44</option>
                                <option value="75">75</option>
                                <option value="90">90</option>
                            </select>
                            <!-- End Select -->
                        </form>
                    </div>

                </div>
                <!-- End Shop-control-bar -->
                <!-- Shop Body -->
                <!-- Tab Content -->
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade pt-2 show active" id="pills-two-example1" role="tabpanel"
                        aria-labelledby="pills-two-example1-tab" data-target-group="groups">
                        <ul class="row list-unstyled products-group no-gutters" id="product-list">


                        </ul>
                    </div>
                </div>
                <!-- End Tab Content -->
                <!-- End Shop Body -->
                <!-- Shop Pagination -->
                {{-- <nav class="d-md-flex justify-content-between align-items-center border-top pt-3"
                    aria-label="Page navigation example">
                    <div class="text-center text-md-left mb-3 mb-md-0">Showing 1–25 of 56 results</div>
                    <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start"
                        id="pagination-links">
                        <li class="page-item"><a class="page-link current" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                    </ul>
                </nav> --}}

                <nav class="d-md-flex justify-content-between align-items-center border-top pt-3"
                    aria-label="Page navigation example">
                    <div class="text-center text-md-left mb-3 mb-md-0">
                        Showing <span id="showing-from">1</span>–<span id="showing-to">25</span> of
                        <span id="total-results">56</span> results <span id="pages">(25)</span>
                    </div>

                    <ul class="pagination mb-0 pagination-shop justify-content-center justify-content-md-start"
                        id="pagination-links">
                    </ul>
                </nav>

                <!-- End Shop Pagination -->
            </div>

        </div>
    </main>

    <script src="frontend/assets/js/product-card.js"></script>
    <script>
        jQuery.noConflict();
        jQuery(document).ready(function($) {
            var slicedProducts = {!! json_encode($SubCategoryWiseProducts->toArray()) !!};
            var currentPage = 1;
            var productsPerPage = parseInt($('#productPerPage').val());
            var totalPages = Math.ceil(slicedProducts.length / productsPerPage);
            var currentSortOption = 'default';
            var selectedBrandIds = [];

            $('#total-results').text(slicedProducts.length);
            $('#showing-from').text(currentPage);
            $('#showing-to').text(productsPerPage);
            $('#pages').text(totalPages === 1 ? "(" + totalPages + " page)" : "(" + totalPages + " pages)");


            function updateDisplayedProducts(products) {
                slicedProducts = products;
                currentPage = 1;
                totalPages = Math.ceil(slicedProducts.length / productsPerPage);

                // Reinitialize pagination
                $('#pagination-links').twbsPagination('destroy');
                $('#pagination-links').twbsPagination({
                    totalPages: totalPages,
                    visiblePages: 3,
                    onPageClick: function(event, page) {
                        if (currentPage !== page) {
                            displayProducts(page);
                            // updateShowingInfo(page);
                        }
                        updateShowingInfo(page);
                    }
                });

                // Display products of the current page
                displayProducts(currentPage);
            }

            function applyFiltersAndSort() {

                slicedProducts = {!! json_encode($SubCategoryWiseProducts->toArray()) !!};
                // Apply brand filter
                var filteredProducts = selectedBrandIds.length > 0 ?
                    slicedProducts.filter(product => selectedBrandIds.includes(product.brand_id)) :
                    slicedProducts;

                // Apply sorting
                if (currentSortOption === 'low-to-high') {
                    filteredProducts.sort((a, b) => a.selling_price - b.selling_price);
                } else if (currentSortOption === 'high-to-low') {
                    filteredProducts.sort((a, b) => b.selling_price - a.selling_price);
                }

                updateDisplayedProducts(filteredProducts);
            }

            $('#sort-select').on('change', function() {
                currentSortOption = $(this).val();
                applyFiltersAndSort();
            });

            // Handle products per page selection change
            $('#productPerPage').on('change', function() {
                productsPerPage = parseInt($(this).val());
                applyFiltersAndSort();
            });

            $('.brand_filter').on('change', function() {
                selectedBrandIds = $('.brand_filter:checked').map(function() {
                    return parseInt($(this).val());
                }).get();
                applyFiltersAndSort();
            });

            function displayProducts(page) {
                var startIndex = (page - 1) * productsPerPage;
                var endIndex = startIndex + productsPerPage;
                var paginatedProducts = slicedProducts.slice(startIndex, endIndex);

                var productHtml = '';

                paginatedProducts.forEach(function(product) {
                    // Generate product HTML for each product
                    // Append to productHtml
                    productHtml += generateProductHtml(product);
                });

                $('#product-list').html(productHtml);
            }

            // function generateProductHtml(product) {
            //     return `<li class="col-12 col-sm-6 col-md-3 col-wd-2gdot4 product-item remove-divider-md-lg remove-divider-xl">
            //     <div class="product-item__outer h-100">
            //         <div class="product-item__inner px-xl-4 p-3">
            //             <div class="product-item__body pb-xl-2">

            //                 <h5 class="mb-1 product-item__title"><a href='/product/details/${product.product_slug}/${product.enc_id}'
            //                         class="text-blue font-weight-bold">${product.product_name}</a></h5>
            //                 <div class="mb-2 px-8 p-sm-0">
            //                     <a href='/product/details/${product.product_slug}/${product.enc_id}'
            //                         class="d-block text-center"><img class="img-fluid"
            //                             src="/${product.product_thambnail}"
            //                             alt="Image Description"></a>
            //                 </div>
            //                 <ul class="font-size-12 p-0 text-gray-110 mb-4">
            //                     ${product.short_descp && product.short_descp.match(/<li>(.*?)<\/li>/g)
            //                     ? product.short_descp.match(/<li>(.*?)<\/li>/g).map(item => {
            //                         const text = item.match(/<li>(.*?)<\/li>/)[1];
            //                         return `<li class="line-clamp-1 mb-1 list-bullet">${text}</li>`;
            //                     }).join('')
            //                     : ''}
            //                 </ul>

            //                 <div class="text-gray-20 mb-2 font-size-12">SKU: ${product.product_code}</div>
            //                 @auth
            //                 <div class="flex-center-between mb-2">
            //                     <div class="prodcut-price">
            //                         <del class="font-size-12 tex-gray-6">${product.discount_price != null ? `${formatPrice(product.selling_price)}${currencySymbol}` : ""}</del>
            //                         <ins class="font-size-16 text-red text-decoration-none">${product.discount_price != null ? `${formatPrice(product.discount_price)}${currencySymbol}` : `${formatPrice(product.selling_price)} ${currencySymbol}`}</ins>

            //                     </div>
            //                     <div class="d-none d-xl-block prodcut-add-cart">
            //                         <a onclick="addToCart(this)" data-product-id="${btoa(product.id)}" href="javascript:void(0)"
            //                             class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
            //                     </div>
            //                 </div>
            //                 @else
            //                 <div class="prodcut-add-cart">
            //                                         <a href="{{ route('login') }}"
            //                                             class="btn btn-primary transition-3d-hover btn-block"><i
            //                                                 class="ec ec-login"></i>Login to see price</a>
            //                                     </div>
            //                                 @endauth
            //             </div>
            //             <div class="product-item__footer">
            //                 <div class="border-top pt-2 flex-center-between flex-wrap">
            //                     <a href="javascript:void(0)" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
            //                     <a href="javascript:void(0)" onclick="addWishlist(this)" data-product="${btoa(product.id)}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
            //                 </div>
            //             </div>
            //         </div>
            //     </div>
            // </li>`;
            // }

            function updateShowingInfo(page) {
                currentPage = page;

                var itemsPerPage = productsPerPage;
                var totalItems = slicedProducts.length; // Total number of products in the filtered result

                var startIndex = (currentPage - 1) * itemsPerPage;
                var endIndex = Math.min(startIndex + itemsPerPage, totalItems);

                $('#total-results').text(totalItems);
                $('#showing-from').text(startIndex + 1);
                $('#showing-to').text(endIndex);
                $('#pages').text(totalPages === 1 ? "(" + totalPages + " page)" : "(" + totalPages + " pages)");

            }


            // Initialize pagination and display initial products
            $('#pagination-links').twbsPagination({
                totalPages: totalPages,
                visiblePages: 3,
                onPageClick: function(event, page) {
                    if (currentPage !== page) {
                        displayProducts(page);
                        updateShowingInfo(page);
                    }
                }
            });
            displayProducts(currentPage); // Display initial products

        });
    </script>


<script>
   function formatPrice(price) {
    price = Number(price);
    // Format the price with commas as separators
    return price.toLocaleString('en');
  }
  </script>
@endsection
