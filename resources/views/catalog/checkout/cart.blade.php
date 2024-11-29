@extends('catalog.common.base')

@push('setTitle')
    Cart
@endpush

@section('content')

<section class="container py-4">
    <div class="card p-3">
         <h2>My Cart</h2>
         <!-- Alert message -->
         @include('catalog.common.alert')
         <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th width="10%">Product ID</th>
                    <th width="10%">Image</th>
                    <th width="35%">Product Name</th>
                    <th width="13%">Quantity</th>
                    <th width="10%">Stock Status</th>
                    <th width="10%">Price</th>
                    <th width="17%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($total > 0)
                    @foreach ($carts as $cart)
                        <tr>
                            <td><a href="{{ route('catalog.product-detail', ['product_id' => $cart['product_id'], 'slug' => $cart['slug']]) }}">{{ $cart['product_id'] }}</a></td>
                            <td class="text-center"><a href="{{ route('catalog.product-detail', ['product_id' => $cart['product_id'], 'slug' => $cart['slug']]) }}"><img height="80" src="{{ $cart['image'] }}" alt=""></a></td>
                            <td>{{ $cart['product_name'] }}</td>
                            <td>
                                <div class="d-flex" style="column-gap: 15px">
                                    <button class="border pb-2 text-center" style="width: 30px; height:30px" onclick="decreaseQunatity()" ><i class="fa-solid fa-minus"></i></button>
                                    <input class="border text-center" style="width: 30px; height:30px" type="text" id="quantity" value="{{ $cart['quantity'] }}">
                                    <button class="border pb-2 text-center" style="width: 30px; height:30px" onclick="increaseQunatity()"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </td>
                            <td>
                                @if ($cart['stock_status'] == 'In Stock')
                                    <span class="badge bg-success">{{ $cart['stock_status'] }}</span>
                                @else
                                    <span class="badge bg-warning">{{ $cart['stock_status'] }}</span>
                                @endif
                            </td>
                            <td>Rs.{{ $cart['price'] }}</td>
                            <td>
                                <div class="d-flex justify-content-between" style="gap: 5px">
                                    <a href="#" class="btn btn-warning">Buy</a>
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
 </section>

 <script>
    // increase quantity
    function increaseQunatity() {
        let product_id = '';
        let action = {!! json_encode(route('catalog.increaseQunatity')) !!}
        let current_quantity = parseInt(document.getElementById('quantity').value);
        let total_quantity = document.getElementById('quantity').value = current_quantity +  1;

        console.log(total_quantity)
        
        // $.ajax({
        //     url: action,
        //     method: 'POST',
        //     data: {
        //         _token: '{{ csrf_token() }}',
        //         product_id: product_id,
        //         quantity: quantity
        //     },
        //     success: function(response) {
        //         if (response.success) {
        //             alert(response.message);
        //         }else {
        //             alert(response.message);
        //         }
        //     },
        //     error: function(xhr, status, error) {
        //         console.error('Error:', error);
        //         alert('An error occurred while adding to cart.');
        //     }
        // });
    }

    // increase quantity
    function decreaseQunatity() {
        let product_id = '';
        let action = {!! json_encode(route('catalog.increaseQunatity')) !!}
        let current_quantity = parseInt(document.getElementById('quantity').value);
        let total_quantity = document.getElementById('quantity').value = current_quantity -  1;

        console.log(total_quantity)
    }
 </script>

@endsection