@extends('catalog.common.base')

@push('setTitle') Herculeen Activewear @endpush

@section('content')

    <!-- Carousel -->
    @include('catalog.common.carousel')

    <!-- products -->
    <section class="bg-light">
        <div class="container-fluid px-4">
            <div class="py-4">
                <div class="section-header d-flex flex-wrap align-items-center justify-content-between">
                    <h2 class="section-title fs-3">Featured Products</h2>            
                    <div class="btn-wrap">
                        <a href="{{$product_route}}" class="d-flex align-items-center text-dark">View all products <i class="fa-solid fa-arrow-right ms-2"></i></a>
                    </div>            
                </div>
                <!-- All products -->
                {!! $product_thumb !!}
            </div>

            <!-- categories -->
            <div class="pb-4">
                <div class="section-header d-flex flex-wrap align-items-center justify-content-between">
                    <h2 class="section-title fs-3">Categories</h2>            
                    <div class="btn-wrap">
                        <a href="{{ $category_route }}" class="d-flex align-items-center text-dark">View all categories <i class="fa-solid fa-arrow-right ms-2"></i></a>
                    </div>            
                </div>
                <!-- All category  -->
                <div class="row">
                    @foreach ($categories as $category)
                        <div class="col-6 col-sm-3 col-md-2">
                            <a href="{{ route('catalog.product-all', [$category->id, $category->slug]) . '?sort=latest' }}">
                                <div class="p-1 category_image">
                                    <img class="category-img" src="{{ isset($category->image) ? asset('image/category/' . $category->image) : asset('not-image-available.png') }}" alt="{{ $category->category_name }}">
                                </div>
                                <p class="text-center mt-2 text-dark">{{ $category->category_name }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>



@endsection