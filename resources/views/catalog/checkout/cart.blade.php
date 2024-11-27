@extends('catalog.common.base')

@push('setTitle')
    Cart
@endpush

@section('content')

<section class="container py-4">
    <div class="card p-3">
         <h2>My Cart</h2>
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
                            <td class="text-center"><a href="{{ route('catalog.product-detail', ['product_id' => $cart['product_id'], 'slug' => $cart['slug']]) }}"><img height="100" src="{{ $cart['image'] }}" alt=""></a></td>
                            <td>{{ $cart['product_name'] }}</td>
                            <td>
                                <div class="d-flex" style="column-gap: 15px">
                                    <button class="border pb-2 text-center" style="width: 30px; height:30px" id="qty_minus"><i class="fa-solid fa-minus"></i></button>
                                    <input class="border text-center" style="width: 30px; height:30px" type="text" name="quantity" value="{{ $cart['quantity'] }}">
                                    <button class="border pb-2 text-center" style="width: 30px; height:30px" id="qty_plus"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </td>
                            <td><span class="badge bg-success">In Stock</span></td>
                            <td>Rs.{{ $cart['price'] }}</td>
                            <td>
                                <a href="#" class="btn btn-primary"><i class="fa-solid fa-cart-plus"></i></a>
                                <a href="#" class="btn btn-danger ms-2"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr> 
                    @endforeach                   
                @else
                    <caption class="text-center">Cart is empty</caption>
                @endif
            </tbody>
        </table>
    </div>
 </section>

@endsection