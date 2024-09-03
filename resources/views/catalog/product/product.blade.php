@extends('catalog.common.base')

@push('setTitle') Product @endpush

@section('content')


@if (null !== $product)
<section class="container-fluid py-3">
   <div class="container">
        <div class="row">
            <div class="col-sm-6 mb-3">
                <div class="row">
                    @if ($product['images'])
                        <div class="col-sm-2 text-center">
                            @foreach ($product['images'] as $image)
                                <img class="mb-3 product_side_image" data-id="1" width="70" height="70" src="{{ asset("image/cache/products").'/'.($product['product']->id .'/'. str_replace(".jpg",'',$image->image) .'_100x100.jpg') }}" data-src="{{ asset("image/products").'/'.($product['product']->id .'/'. $image->image) }}">
                            @endforeach
                        </div>
                    @endif
                    <div class="col-sm-10 text-center product overflow-hidden">
                        <img class="mb-3 product_image" src="{{ ($product['product']->image) ? asset("image/products").'/'.($product['product']->id .'/'.$product['product']->image) : asset('image/not-image-available.png')}}" style="max-height: 550px">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="header">
                    <h2>{{ $product['product']->product_name }}</h2>
                    <div class="d-flex mt-4">
                        <h5 class="me-3"><strong>Rs. </strong>{{ number_format($product['product']->list_price,0) }}</h5>
                        <h5 class="text-danger"><strong>Rs. </strong><del>{{ number_format($product['product']->mrp,0) }}</del></h5>
                    </div>
                    <p>Inclusive of all Taxes</p>
                    <hr>
                </div>
                
                <div class="colors mb-4">
                    <h2 class="fs-6">Colors</h2>
                    <div class="d-flex" style="column-gap: 15px">
                        <a class="border" href="#"><img width="50" height="50" src="{{ asset('image/product/product-item1.jpg') }}"></a>
                        <a class="border" href="#"><img width="50" height="50" src="{{ asset('image/product/product-item1.jpg') }}"></a>
                        <a class="border" href="#"><img width="50" height="50" src="{{ asset('image/product/product-item1.jpg') }}"></a>
                        <a class="border" href="#"><img width="50" height="50" src="{{ asset('image/product/product-item1.jpg') }}"></a>
                        <a class="border" href="#"><img width="50" height="50" src="{{ asset('image/product/product-item1.jpg') }}"></a>
                    </div>
                </div>
                    
                <div class="mb-4">
                    <h2 class="fs-6">Size</h2>
                    <div class="d-flex align-items-center" style="column-gap: 15px">
                        <a class="border text-dark text-center py-2" style="width: 50px;" href="#">XS</a>
                        <a class="border text-dark text-center py-2" style="width: 50px;" href="#">S</a>
                        <a class="border text-dark text-center py-2" style="width: 50px;" href="#">M</a>
                        <a class="border text-dark text-center py-2" style="width: 50px;" href="#">L</a>
                        <a class="border text-dark text-center py-2" style="width: 50px;" href="#">XL</a>
                    </div>
                </div>
                <div class="mb-4">
                    <h2 class="fs-6">Quantity</h2>
                    <div class="d-flex" style="column-gap: 15px">
                        <button class="border py-2" style="width: 50px;"><i class="fa-solid fa-minus"></i></button>
                        <input class="border py-2 text-center" style="width: 50px;" type="text" name="quantity" value="1">
                        <button class="border py-2" style="width: 50px;"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <div class="mb-4">
                    <h2 class="fs-6"><i class="fa-solid fa-truck-moving"></i> Check delivery at your location</h2>
                    <div class="d-flex" style="column-gap: 15px">
                        <input class="w-50 rounded-0 border border-dark px-2 py-2" type="text" name="" id="" placeholder="Enter your pincode">
                        <button class="btn btn-dark rounded-0 py-2">CHECK</button>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="d-flex" style="column-gap: 15px">
                        <input class="btn btn-white rounded-0 border border-dark py-2" style="width:35%" type="submit" value="ADD TO CART">
                        <input class="btn btn-dark rounded-0 border border-dark py-2" style="width:35%" type="submit" value="BUY IT NOW">
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-dark"><i class="fa-regular fa-heart"></i> ADD TO WISHLIST</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card rounded-0 p-3 mb-3">
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="false">Description</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Review</button>
                </li>
            </ul>
            <!-- Description -->
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                {{ strip_tags($product['product']->product_description) }}
            </div>

            <!-- Review -->
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                
            </div>
        </div>
   </div>
</section>

<script>
    const product_side_images = document.querySelectorAll('.product_side_image');
    product_side_images.forEach(side_image => {
        side_image.addEventListener('mouseover', () => {
            document.querySelector('.product_image').src = side_image.getAttribute('data-src');
        });
    });

</script>

@endif

@endsection
