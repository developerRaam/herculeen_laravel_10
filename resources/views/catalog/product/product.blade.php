@extends('catalog.common.base')

<!-- meta tags -->
@push('setTitle'){{ $product['product']->product_name }} @if (app('settings') && isset(app('settings')['site_title']))| {{ app('settings')['site_title'] }}@endif @endpush
@push('setDescription'){{ $product['product']->meta_description }}@endpush
@push('setKeyword'){{ $product['product']->tag }}@endpush
@push('setCanonicalURL'){{ route('catalog.product-detail', ['product_id' => $product['product']->id, 'slug' => $product['product']->slug]) }}@endpush

@section('content')
@if (null !== $product)
<section class="container-fluid py-3">
   <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 mb-3">
                <div class="text-center product overflow-hidden border bg-white">
                    <img class="mb-3 product_image" src="{{ ($product['product']->image) ? asset("image/products").'/'.($product['product']->id .'/'.$product['product']->image) : asset('not-image-available.png')}}" style="max-height: 550px">
                </div>
                <div class="d-flex flex-wrap">
                    @if ($product['images'])
                        @foreach ($product['images'] as $image)
                        <div class="text-center pe-2">
                            <img class="product_side_image border p-1" data-id="1" width="70" height="70" src="{{ asset("image/cache/products").'/'.($product['product']->id .'/'. str_replace(".jpg",'',$image->image) .'_100x100.jpg') }}" data-src="{{ asset("image/cache/products").'/'.($product['product']->id .'/'. str_replace(".jpg",'',$image->image) .'_700x700.jpg') }}">
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="header">
                    <h2 style="font-family: 'Arial', sans-serif;">{{ $product['product']->product_name }}</h2>
                    <div class="d-flex mt-4">
                        <h5 class="me-3"><strong>Rs. </strong>{{ number_format($product['product']->price,0) }}</h5>
                        {{-- <h5 class="text-danger"><strong>Rs. </strong><del>{{ number_format($product['product']->mrp,0) }}</del></h5> --}}
                    </div>
                    {{-- <p>Inclusive of all Taxes</p> --}}
                    <hr>
                </div>
                
                {{-- <div class="colors mb-4">
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
                </div> --}}
                {{-- <div class="mb-4">
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
                </div> --}}
                {{-- <div class="mb-4">
                    <div class="d-flex" style="column-gap: 15px">
                        <input class="btn btn-white rounded-0 border border-dark py-2" style="width:35%" type="submit" value="ADD TO CART">
                        <input class="btn btn-dark rounded-0 border border-dark py-2" style="width:35%" type="submit" value="BUY IT NOW">
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-dark"><i class="fa-regular fa-heart"></i> ADD TO WISHLIST</a>
                    </div>
                </div> --}}

                {{-- Other link url --}}
                @if(app('settings')['ecommerce_other_url_status'])
                    @if($ecommerce_url && $ecommerce_url->status)
                        <h2 class="custom-title text-center mb-3">Click To Buy</h2>
                        <p class="text-center text-danger"><i class="fa-solid fa-angles-down"></i></p>
                        @if($ecommerce_url->amazon)
                            <div class="mb-4">
                                <a target="blank" href="{{ $ecommerce_url->amazon }}" class="text-decoration-none">
                                    <div class="custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <p class="me-2 mb-0"><img height="30" src="{{ URL::asset('icon/amazon.png') }}" alt="Amazon"></i></p>
                                                <p class="mb-0">Amazon</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        @if($ecommerce_url->flipkart)
                            <div class="mb-4">
                                <a href="{{ $ecommerce_url->flipkart }}" target="blank" class="text-decoration-none">
                                    <div class="custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <p class="me-2 mb-0"><img src="{{ URL::asset('icon/flipkart.png') }}" width="30" height="30" alt="Flpkart"></p>
                                                <p class="mb-0">Flpkart</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        @if($ecommerce_url->ajio)
                            <div class="mb-4">
                                <a href="{{ $ecommerce_url->ajio }}" target="blank" class="text-decoration-none">
                                    <div class="custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <p class="me-2 mb-0"><img height="30" src="{{ URL::asset('icon/ajio.png') }}" alt="Ajio"></p>
                                                <p class="mb-0">Ajio</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        @if($ecommerce_url->myntra)
                            <div class="mb-4">
                                <a href="{{ $ecommerce_url->myntra }}" target="blank" class="text-decoration-none">
                                    <div class="custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <p class="me-2 mb-0"><img width="30" src="{{ URL::asset('icon/myntra.png') }}" alt="Myntra"></p>
                                                <p class="mb-0">Myntra</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        @if($ecommerce_url->meesho)
                            <div class="mb-4">
                                <a href="{{ $ecommerce_url->meesho }}" target="blank" class="text-decoration-none">
                                    <div class="custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <p class="me-2 mb-0"><img height="30" src="{{ URL::asset('icon/meesho.png') }}" alt="Meesho"></p>
                                                <p class="mb-0">Meesho</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endif
                @endif

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
            <div class="tab-content" id="myTabContent">
                <!-- Description -->
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    <div>
                        {!! $product['product']->product_description !!}
                    </div>
                </div>

                <!-- Review -->
                <div class="tab-pane fade show" id="review" role="tabpanel" aria-labelledby="review-tab">
                </div>
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
