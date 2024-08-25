
<style>
  .truncate-two-lines {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    height: 2.6em; /* Adjust this value based on your line-height */
}
</style>

<div class="row">
  @if ($products)
  @forelse ($products as $product)
    <div class="col-sm-2 col-md-4 col-lg-2  ">
        <div class="product-item">
            <div class="image-holder">
              <img src="{{ ($product->image) ? asset("image/uploads").'/'.($product->image) : asset('image/not-image-available.png')}}" alt="{{$product->product_name}}" class="product-image" style="max-height:300px;object-fit:contain;">
            </div>
            <div class="cart-concern">
              <div class="cart-button d-flex justify-content-center align-items-center p-1" style="background-color: #eceef1;">
                <div class="col-6 border-end">
                  <a href="#" class="text-decoration-none text-dark pe-3">
                    <i class="fa-regular fa-heart p-2 fs-4 rounded-circle" style="color:#ff006f"></i>
                  </a>
                </div>
                 <div class="col-6">
                   <a href="#" class="text-decoration-none text-dark">
                       <i class="fa-solid fa-cart-plus p-2 fs-4 rounded-circle" style="color:#ff006f"></i>
                   </a>
                 </div>
              </div>
            </div>
            <div class="product-detail">
              <h3 class="product-title fs-6 truncate-two-lines">
                <a href="{{ route('product-detail', ['product_id' => $product->product_id, 'slug' => $product->slug]) }}">{{$product->product_name}}</a>
              </h3>
              <span class="text-primary fs-6"><strong>Rs.</strong>{{ number_format($product->list_price, 0) }}</span>
            </div>
        </div>
    </div>
  @empty
      
  @endforelse
      
  @endif
</div>