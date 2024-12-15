@extends('catalog.common.base')

@push('setTitle')
    Cart
@endpush

@section('content')

<section class="container-fluid py-4">
    <h2 class="text-center mb-4"><i class="fa-solid fa-bag-shopping"></i> My Cart</h2>

    <!-- Alert message -->
    @include('catalog.common.ajax_alert')
    @include('catalog.common.alert')

    <div class="row g-4">
        <div class="col-md-9">
            <div class="card p-2 overflow-auto">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th width="20%"></th>
                            <th width="40%">Product Name</th>
                            <th width="20%">Quantity</th>
                            <th width="10%">Price</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($cart_total > 0)
                            @foreach ($carts as $cart)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{ route('catalog.product-detail', ['product_id' => $cart['product_id'], 'slug' => $cart['slug']]) }}">
                                            <img class="border p-1 px-5" height="150" src="{{ $cart['image'] }}" alt="{{ $cart['product_name'] }}">
                                        </a>
                                    </td>
                                    <td>
                                        <p class="mb-0" style="font-size: 15px">
                                            <a class="text-dark fw-bold" href="{{ route('catalog.product-detail', ['product_id' => $cart['product_id'], 'slug' => $cart['slug']]) }}">{{ $cart['product_name'] }}</a>
                                        </p>
                                        {{-- <p class="mb-0 text-muted">Color: <span>Red</span></p> --}}
                                        <p class="mb-0 text-muted">
                                            @if ($cart['stock_status'] == 'In Stock')
                                                <span class="badge bg-success">{{ $cart['stock_status'] }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ $cart['stock_status'] }}</span>
                                            @endif
                                        </p>
                                    </td>
                                    <td>
                                        @if ($cart['stock_status'] == 'In Stock')
                                            <div class="d-flex" style="column-gap: 15px">
                                                <button class="border pb-2 text-center" style="width: 30px; height:30px" onclick="decreaseQunatity({{$cart['product_id']}})" ><i class="fa-solid fa-minus"></i></button>
                                                <input class="border text-center" style="width: 30px; height:30px" type="text" readonly id="quantity_{{$cart['product_id']}}" value="{{ $cart['quantity'] }}">
                                                <button class="border pb-2 text-center" style="width: 30px; height:30px" onclick="increaseQunatity({{$cart['product_id']}})"><i class="fa-solid fa-plus"></i></button>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cart['stock_status'] == 'In Stock')
                                        <strong>Rs.</strong><span id="price_{{$cart['product_id']}}">{{ $cart['price'] }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between" style="gap: 5px">
                                            <a href="{{ route('catalog.removeCartProduct',['product_id' => $cart['product_id'], "product_name" => $cart['product_name'] ]) }}" class="btn btn-danger">Remove</a>
                                        </div>
                                    </td>
                                </tr> 
                            @endforeach                   
                        @else
                            <caption class="text-center"><h4>Cart is empty</h4></caption>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-3">
            @if ($cart_total > 0)
            <div class="card p-4 mx-auto">
                <div class="d-flex mb-3 gap-2">
                    <input type="text" class="form-control rounded-0" placeholder="Enter Coupon Code">
                    <button class="btn btn-dark rounded-0">Apply</button>
                </div>

                <div>
                    <p class="mb-0">Price Details ( {{$cart_total}} @if($cart_total >= 2)items @else item @endif)</p>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="text-muted">Total MRP</td>
                            <td class="text-end">
                                <span class="fw-bold"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                                <span id="total_mrp">{{ $total_mrp }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Discount on MRP</td>
                            <td class="text-end text-success">
                                <span class="fw-bold"> - <i class="fa-solid fa-indian-rupee-sign"></i></span>
                                <span id="discount_on_mrp">{{ $discount_on_mrp }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Coupon Discount</td>
                            <td class="text-end text-success">
                                <span class="fw-bold"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                                <span id="coupon_discount">0</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Platform Fee</td>
                            <td class="text-end text-success">
                                <span id="platform_fee">Free</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Shipping Fee</td>
                            <td class="text-end text-success">
                                <span id="shipping_fee">Free</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Total Amount</td>
                            <td class="text-end fw-bold">
                                <span class="fw-bold"><i class="fa-solid fa-indian-rupee-sign"></i></span>
                                <span id="total_amount">{{ $total_amount }}</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            
                <div class="">
                    <a href="#" class="btn btn-warning px-4 py-2 fw-bold text-uppercase">Checkout</a>
                </div>
            </div>
            
            @endif
        </div>

    </div>
 </section>

 <script>
    // increase quantity
    function increaseQunatity(product_id) {
        let current_quantity = parseInt(document.getElementById('quantity_' + product_id).value);
        let total_quantity = document.getElementById('quantity_' + product_id).value = current_quantity +  1;
        let user_id = {!! json_encode(session('isUser')) !!}
        let action = {!! json_encode(route('catalog.addCart')) !!}
        
        if(user_id){
            $.ajax({
                url: action,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: user_id,
                    product_id: product_id,
                    quantity: total_quantity
                },
                success: function(response) {
                    if (response.success) {
                        document.getElementById('price_' + product_id).textContent = response.price
                        document.getElementById('total_mrp').textContent = response.total_mrp
                        document.getElementById('discount_on_mrp').textContent = response.discount_on_mrp
                        document.getElementById('total_amount').textContent = response.total_amount
                        // showFlashMessage('success', response.message)
                    }else {
                        showFlashMessage('error', response.message)
                    }
                },
                error: function(xhr, status, error) {
                    showFlashMessage('error','An error occurred while adding to cart.')
                }
            });
        }else{
            window.location.href =  {!! json_encode(route('catalog.user-login')) !!}
        }
    }

    // decrease quantity
    function decreaseQunatity(product_id) {
        let current_quantity = parseInt(document.getElementById('quantity_' + product_id).value);
        let total_quantity = 1;
        if(current_quantity > 1){
            total_quantity = document.getElementById('quantity_' + product_id).value = current_quantity -  1;
        }
        let user_id = {!! json_encode(session('isUser')) !!}
        let action = {!! json_encode(route('catalog.addCart')) !!}

        if(user_id){
            $.ajax({
                url: action,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: user_id,
                    product_id: product_id,
                    quantity: total_quantity
                },
                success: function(response) {
                    if (response.success) {
                        document.getElementById('price_' + product_id).textContent = response.price
                        document.getElementById('total_mrp').textContent = response.total_mrp
                        document.getElementById('discount_on_mrp').textContent = response.discount_on_mrp
                        document.getElementById('total_amount').textContent = response.total_amount
                        // showFlashMessage('success', response.message)
                    }else {
                        showFlashMessage('error', response.message)
                    }
                },
                error: function(xhr, status, error) {
                    showFlashMessage('error','An error occurred while adding to cart.')
                }
            });
        }else{
            window.location.href =  {!! json_encode(route('catalog.user-login')) !!}
        }
    }
 </script>

@endsection