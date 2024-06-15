@extends('catalog.common.base')

@push('setTitle') Product @endpush

@section('content')



<section class="container-fluid py-3">
   <div class="container">
    <div class="row">
        <div class="col-sm-6 mb-3">
            <div class="row">
                <div class="col-sm-2 text-center">
                    <img class="mb-3 product_side_image" data-id="1" height="100" src="{{ asset('image/product/product-item1.jpg') }}">
                    <img class="mb-3 product_side_image" data-id="2" height="100" src="{{ asset('image/product/product-item2.jpg') }}">
                    <img class="mb-3 product_side_image" data-id="3" height="100" src="{{ asset('image/product/product-item4.jpg') }}">
                    <img class="product_side_image" data-id="4" height="100" src="{{ asset('image/product/product-item1.jpg') }}">
                </div>
                <div class="col-sm-10 text-center product overflow-hidden">
                    <img class="mb-3 product_image" src="{{ asset('image/product/product-item1.jpg') }}" style="max-height: 550px">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="header">
                <h2>Full Sleeve Cover Shirt</h2>
                <h5>Rs.40.00</h5>
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
            <div class="mb-4">
                <p>Reinvent your style silhouette with the OG sneaks. Grab a classic pair of sneakers from CAMPUS and turn heads with your remarkable style. Bringing the ever-loved combination of sky blue and white to your shoe-drobe, these shoes are made to complement every style of yours. Lace up for a fun day out in shorts or jeans. Or pair these with your favorite bodycon dress like a true fashionista.</p>
            </div>
        </div>
    </div>
   </div>
</section>

<script>
    const product_side_images = document.querySelectorAll('.product_side_image');
    product_side_images.forEach(side_image => {
        side_image.addEventListener('mouseover', () => {
            document.querySelector('.product_image').src = side_image.src
        });
    });

</script>


@endsection