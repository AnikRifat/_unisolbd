@php
    $hotdeals=App\Models\Product::where('hot_deals',1)->where('discount_price','!=',null)->orderBy('id','DESC')->get();
@endphp


<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">
      @if (session()->get('language')=='hindi')
      जबरदस्त सौदे
      @else
      hot deals
      @endif
    </h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
      @foreach ($hotdeals as $hotdeal)
      <div class="item">
        <div class="products">
          <div class="hot-deal-wrapper">
            <div class="image"> 
              <img src="{{ asset($hotdeal->product_thambnail) }}" alt=""> 
            </div>
            
            @php
            $discount=(($hotdeal->selling_price-$hotdeal->discount_price)/$hotdeal->selling_price)*100;
            @endphp
          
            
            <div class="sale-offer-tag">
              @if ($hotdeal->discount_price!=NULL)
              <span>{{ round($discount) }}%<br>off</span>
              @else
              <span>New</span>
              @endif
            </div>
            <div class="timing-wrapper">
              <div class="box-wrapper">
                <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
              </div>
              <div class="box-wrapper">
                <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
              </div>
              <div class="box-wrapper">
                <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
              </div>
              <div class="box-wrapper hidden-md">
                <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
              </div>
            </div>
          </div>
          <!-- /.hot-deal-wrapper -->
          
          <div class="product-info text-left m-t-20">
            <h3 class="name">
              <a href="{{ url('/product/details/'.$hotdeal->id.'/'.$hotdeal->product_slug_en) }}">
                @if (session()->get('language')=='hindi')
                {{ $hotdeal->product_name_hin }}
                @else
                {{ $hotdeal->product_name }}
                @endif
              </a>
            </h3>
            <div class="rating rateit-small"></div>
            <div class="product-price"> 
              @if ($hotdeal->discount_price==NULL)
              <span class="price"> ${{ $hotdeal->selling_price }} </span> 
              @else
              <span class="price"> ${{ $hotdeal->discount_price }} </span> 
              <span class="price-before-discount">${{ $hotdeal->selling_price }}</span> 
              @endif
             </div>
            <!-- /.product-price --> 
            
          </div>
          <!-- /.product-info -->
          
          <div class="cart clearfix animate-effect">
            <div class="action">
              <div class="add-cart-button btn-group">
                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
              </div>
            </div>
            <!-- /.action --> 
          </div>
          <!-- /.cart --> 
        </div>
      </div>
      @endforeach
    </div>
    <!-- /.sidebar-widget --> 
  </div>