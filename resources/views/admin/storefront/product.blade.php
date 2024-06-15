@extends('admin.common.base')

@push('setTitle')
    {{$heading_title}}
@endpush

@section('content')
<section class="container-fluid px-0">
    <div class="row">
        <div class="col-sm-12">
            @include('admin.common.header')
        </div>
        <div class="col-sm-2 p-0">
            @include('admin.common.left-sidebar')
        </div>
        <div class="col-sm-10 p-0">
            <div class="m-4">
                <div class="admin-title d-flex justify-content-between px-2">
                    <div class="d-flex admin-title-box">
                        <h2>{{$heading_title}}</h2>
                        <div class="breadcrumbs">
                            <ul class="ms-3">
                                @foreach ($breadcrumbs as $breadcrumb)
                                    <li><a href="{{$breadcrumb['href']}}">{{$breadcrumb['text']}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div>
                        <a class="btn btn-primary fs-4 px-3" href="{{$add}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add Product"><i class="fa-solid fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="row g-3 px-4">
                <div class="col-sm-9 col-md-9">
                    <!-- Alert Message -->
                    @include('admin.common.alert')

                    <div class="px-3 py-2 title-list">
                        <p class="mb-0"><i class="fa-solid fa-list"></i> Product List</p>
                    </div>
                    <div class="card rounded-0 p-3">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center"><input type="checkbox" class="form-check-input" name="" id=""></th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Model</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="form-check-input" name="" id=""></td>
                                    <td><img width="50" height="50" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREoRGyXmHy_6aIgXYqWHdOT3KjfmnuSyxypw&s" alt=""></td>
                                    <td>T-Shirt</td>
                                    <td>GHHGDD</td>
                                    <td>Rs.788</td>
                                    <td>100</td>
                                    <td>
                                        <a class="btn btn-primary" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fa-solid fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="form-check-input" name="" id=""></td>
                                    <td><img width="50" height="50" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREoRGyXmHy_6aIgXYqWHdOT3KjfmnuSyxypw&s" alt=""></td>
                                    <td>T-Shirt</td>
                                    <td>GHHGDD</td>
                                    <td>Rs.788</td>
                                    <td>100</td>
                                    <td>
                                        <a class="btn btn-primary" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fa-solid fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><input type="checkbox" class="form-check-input" name="" id=""></td>
                                    <td><img width="50" height="50" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREoRGyXmHy_6aIgXYqWHdOT3KjfmnuSyxypw&s" alt=""></td>
                                    <td>T-Shirt</td>
                                    <td>GHHGDD</td>
                                    <td>Rs.788</td>
                                    <td>100</td>
                                    <td>
                                        <a class="btn btn-primary" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fa-solid fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        @include('admin.common.pagination')

                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="px-3 py-2 title-list">
                        <p class="mb-0"><i class="fa-solid fa-filter"></i> Filter</p>
                    </div>
                    <div class="card rounded-0 p-3">
                        <form action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="product_name" class="form-label fw-bold">Product Name</label>
                                <input type="text" class="form-control" id="product_name" placeholder="Product Name">
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label fw-bold">Model</label>
                                <input type="text" class="form-control" id="model" placeholder="Model">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label fw-bold">Price</label>
                                <input type="text" class="form-control" id="price" placeholder="Price">
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label fw-bold">Quantity</label>
                                <input type="text" class="form-control" id="quantity" placeholder="Quantity">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0">Disable</option>
                                    <option value="1">Enable</option>
                                </select>
                            </div>
                            <div class="mb-3 text-end">
                                <input type="submit" class="btn btn-primary" value="Filter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection