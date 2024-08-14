<div class="product-item__outer h-100">
    <div class="product-item__inner px-xl-4 p-3">
        <div class="product-item__body pb-xl-2">
            <div class="mb-2">
                @if ($product->subsubcategory_id != null)
                <a href="{{ url('subsubcategory/product/' . $product->subsubcategory->subsubcategory_slug . '/' . encrypt($product->subsubcategory_id)) }}" class="font-size-12 text-gray-5">{{ $product->subsubcategory->subsubcategory_name }}</a>
                @elseif ($product->subcategory_id != null)
                <a href="{{ url('subcategory/product/' . $product->subcategory->subcategory_slug . '/' . encrypt($product->subcategory_id)) }}" class="font-size-12 text-gray-5">{{ $product->subcategory->subcategory_name }}</a>
                @else
                <a href="{{ url('category/product/' . $product->category->category_slug . '/' . encrypt($product->category_id)) }}" class="font-size-12 text-gray-5">{{ $product->category->category_name }}</a>
                @endif
            </div>
            <h5 class="mb-1 product-item__title"><a href="{{ url('/product/details/' . $product->product_slug . '/' . encrypt($product->id)) }}" class="text-blue font-weight-bold" data-toggle="tooltip" data-placement="top" title="{{ $product->product_name }}">{{ $product->product_name }}</a>
            </h5>
            <div class="mb-2">
                <a href="{{ url('/product/details/' . $product->product_slug . '/' . encrypt($product->id)) }}" class="d-block text-center"><img class="img-fluid" src="{{ asset($product->product_thambnail) }}" alt="Image Description"></a>
            </div>
            @auth
            <div class="flex-center-between mb-1">
                <div class="prodcut-price d-flex align-items-center flex-wrap position-relative">
                    @if ($product->discount_price != null)
                    <ins class="font-size-20 text-red text-decoration-none mr-2">
                        {{ number_format($product->discount_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                    <del class="font-size-12 tex-gray-6 position-absolute bottom-100">{{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</del>
                    @else
                    <ins class="font-size-20 text-red text-decoration-none mr-2">
                        {{ number_format($product->selling_price, 0, '.', ',') }}{{ $currency->symbol }}</ins>
                    @endif
                </div>
                <div class="prodcut-add-cart">
                    <a href="javascript:void(0)" onclick="addToCart(this)" data-product-id="{{ base64_encode($product->id) }}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                </div>
            </div>
            @else
            <div class="prodcut-add-cart">
                <a href="{{ route('login') }}" class="btn btn-primary transition-3d-hover btn-block"><i class="ec ec-login"></i>Login to see price</a>
            </div>
            @endauth
        </div>
        <div class="product-item__footer">
            <div class="border-top pt-2 flex-center-between flex-wrap">
                <a href="javascript:void(0)" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                <a href="javascript:void(0)" onclick="addWishlist(this)" data-product="{{ base64_encode($product->id) }}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i>Wishlist</a>
            </div>
        </div>
    </div>
</div>