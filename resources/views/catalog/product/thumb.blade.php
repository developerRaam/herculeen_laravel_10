<div class="row">
  @if ($products)
  @forelse ($products as $product)
    <div class="col-sm-2 col-md-4 col-lg-3">
        <div class="product-item">
            <div class="image-holder">
              <img src="{{ ($product->image) ? asset("image/uploads").'/'.($product->image) : asset('image/not-image-available.png')}}" alt="{{$product->product_name}}" class="product-image">
            </div>
            <div class="cart-concern">
              <div class="cart-button d-flex justify-content-between align-items-center">
                <button type="button" class="btn-wrap cart-link d-flex align-items-center">add to cart <i class="fa-solid fa-arrow-right ms-2"></i>
                </button>
                {{-- <button type="button" class="view-btn tooltip
                    d-flex">
                  <i class="icon icon-screen-full"></i>
                  <span class="tooltip-text">Quick view</span>
                </button> --}}
                <button type="button" class="wishlist-btn">
                    <i class="fa-regular fa-heart"></i>
                </button>
              </div>
            </div>
            <div class="product-detail">
              <h3 class="product-title fs-3">
                <a href="single-product.html">{{$product->product_name}}</a>
              </h3>
              <span class="item-price text-primary">Rs.{{ number_format($product->list_price, 2) }}</span>
            </div>
        </div>
    </div>
  @empty
      
  @endforelse
      
  @endif
</div>