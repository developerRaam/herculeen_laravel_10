@extends('catalog.common.base')

@push('setTitle')
    Order
@endpush

@section('content')

<section class="container py-4">
    <div class="card p-3">
         <h2>My Order</h2>
         <table class="table table-bordered mt-4">
             <thead>
                 <tr>
                     <th width="5%">#</th>
                     <th width="10%">Image</th>
                     <th width="40%">Product Name</th>
                     <th width="15%">Quantity</th>
                     <th width="15%">Price</th>
                     <th width="20%">Action</th>
                 </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>1</td>
                     <td class="text-center"><a href="#"><img height="100" src="http://127.0.0.1:8000/image/cache/products/32/1729062283_d58687e9-5eef-4824-8f24-83e676f48d0e_700x700.jpg" alt=""></a></td>
                     <td>Lorem ipsum dolor sit amet consectetur adipisicing elit</td>
                     <td>1</td>
                     <td>Rs.300</td>
                     <td>
                         <a href="#" class="btn btn-primary ms-2">View</a>
                     </td>
                 </tr>
             </tbody>
         </table>
    </div>
 </section>

@endsection