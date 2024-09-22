@extends('catalog.common.base')

@push('setTitle') Demo @endpush

@section('content')

    <!-- Carousel -->
    @include('catalog.common.carousel')

    <!-- products -->
    <section class="bg-light">
        <div class="container-fluid px-4">
            <div class="py-5">
                <div class="section-header d-flex flex-wrap align-items-center justify-content-between">
                    <h2 class="section-title fs-3">Featured Products</h2>            
                    <div class="btn-wrap">
                        <a href="{{$category_route}}" class="d-flex align-items-center text-dark">View all products <i class="fa-solid fa-arrow-right ms-2"></i></a>
                    </div>            
                </div>
                <!-- All products -->
                {!! $product_thumb !!}
            </div>
        </div>
    </section>



@endsection