function generateProductHtml(product) {
    console.log(product)
    return `<li class="col-6 col-md-2gdot4 product-item remove-divider-md-lg remove-divider-xl">
    <div class="product-item__outer h-100">
        <div class="product-item__inner px-xl-4 p-3">
            <div class="product-item__body pb-xl-2">

                <h5 class="mb-1 product-item__title"><a href='/product/details/${product.product_slug}/${product.enc_id}'
                        class="text-blue font-weight-bold">${product.product_name}</a></h5>
                <div class="mb-2 px-8 p-sm-0">
                    <a href='/product/details/${product.product_slug}/${product.enc_id}'
                        class="d-block text-center"><img class="img-fluid"
                            src="/${product.product_thambnail}"
                            alt="Image Description"></a>
                </div>
                <ul class="font-size-12 p-0 text-gray-110 mb-4">
                    ${product.short_descp && product.short_descp.match(/<li>(.*?)<\/li>/g)
                    ? product.short_descp.match(/<li>(.*?)<\/li>/g).map(item => {
                        const text = item.match(/<li>(.*?)<\/li>/)[1];
                        return `<li class="line-clamp-1 mb-1 list-bullet">${text}</li>`;
                    }).join('')
                    : ''}
                </ul>

                <div class="text-gray-20 mb-2 font-size-12">SKU: ${product.product_code}</div>
                @auth
                <div class="flex-center-between mb-2">
                    <div class="prodcut-price">
                        <del class="font-size-12 tex-gray-6">${product.discount_price != null ? `${formatPrice(product.selling_price)}${currencySymbol}` : ""}</del>
                        <ins class="font-size-16 text-red text-decoration-none">${product.discount_price != null ? `${formatPrice(product.discount_price)}${currencySymbol}` : `${formatPrice(product.selling_price)} ${currencySymbol}`}</ins>

                    </div>
                    <div class="d-none d-xl-block prodcut-add-cart">
                        <a onclick="addToCart(this)" data-product-id="${btoa(product.id)}" href="javascript:void(0)"
                            class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                    </div>
                </div>
                @else
                <div class="prodcut-add-cart">
                                        <a href="{{ route('login') }}"
                                            class="btn btn-primary transition-3d-hover btn-block"><i
                                                class="ec ec-login"></i>Login to see price</a>
                                    </div>
                                @endauth
            </div>
            <div class="product-item__footer">
                <div class="border-top pt-2 flex-center-between flex-wrap">
                    <a href="javascript:void(0)" class="text-gray-6 font-size-13"><i class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                    <a href="javascript:void(0)" onclick="addWishlist(this)" data-product="${btoa(product.id)}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                </div>
            </div>
        </div>
    </div>
</li>`;
}
