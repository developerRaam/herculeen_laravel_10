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
        <div class="col-sm-2 p-0 bg-left-sidebar">
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
                        <a class="btn btn-primary fs-4 px-3" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Save"><i class="fa-solid fa-floppy-disk"></i></a>
                        <a class="btn btn-primary fs-4 px-3" href="{{$back}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Back"><i class="fa-solid fa-reply"></i></a>
                    </div>
                </div>
            </div>
            <div class="row g-3 px-4">
                <div class="col-sm-12">
                    <!-- Alert Message -->
                    @include('admin.common.alert')

                    <div class="px-3 py-2 title-list">
                        <p class="mb-0"><i class="fa-solid fa-pencil"></i> Add Product</p>
                    </div>
                    <div class="card rounded-0 p-3 mb-3">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="false">General</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false">Data</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="price-tab" data-bs-toggle="tab" data-bs-target="#price" type="button" role="tab" aria-controls="price" aria-selected="false">Price</button>
                              </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="links-tab" data-bs-toggle="tab" data-bs-target="#links" type="button" role="tab" aria-controls="links" aria-selected="false">Links</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="attribute-tab" data-bs-toggle="tab" data-bs-target="#attribute" type="button" role="tab" aria-controls="attribute" aria-selected="false">Attribute</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="discount-tab" data-bs-toggle="tab" data-bs-target="#discount" type="button" role="tab" aria-controls="discount" aria-selected="false">Discount</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="special-tab" data-bs-toggle="tab" data-bs-target="#special" type="button" role="tab" aria-controls="special" aria-selected="false">Special</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reward-tab" data-bs-toggle="tab" data-bs-target="#reward" type="button" role="tab" aria-controls="reward" aria-selected="false">Reward Point</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">Image</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="other-link-tab" data-bs-toggle="tab" data-bs-target="#other-link" type="button" role="tab" aria-controls="other-link" aria-selected="false">Other Link</button>
                            </li>
                        </ul>
                        <!-- Tab content -->
                        <form action="{{ route('admin-setting') }}" id="myForm" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content" id="myTabContent">
                                <!-- General -->
                                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                    <div class="mt-4">
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="product_name">Product Name</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="product_name" name="product_name" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Product Name">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="product_name">Product description</label>
                                            </div>
                                            <div class="col-10">
                                                <textarea id="summernote" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="meta_tag_title">Meta Tag Title</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="meta_tag_title" name="meta_tag_title" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Meta Tag Title">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="meta_tag_keyword">Meta Tag Keywords</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="meta_tag_keyword" name="meta_tag_keyword" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Meta Tag Keyword">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="product_tag">Product Tags</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="product_tag" name="product_tag" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Product Tags">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Data -->
                                <div class="tab-pane fade show" id="data" role="tabpanel" aria-labelledby="data-tab">
                                    <div class="mt-4"></div>
                                    <!-- Model -->
                                    <section class="model">
                                        <h4>Model</h4><hr>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="model">Model</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="model" name="model" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Model">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="sku">SKU</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="sku" name="sku" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="SKU">
                                                <span class="form-text">Stock Keeping Unit</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="upc">UPC</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="upc" name="upc" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="UPC">
                                                <span class="form-text">Universal Product Code</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="ean">EAN</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="ean" name="ean" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="EAN">
                                                <span class="form-text">European Article Number</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="jan">JAN</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="jan" name="jan" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="JAN">
                                                <span class="form-text">Japanese Article Number</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="isbn">ISBN</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="isbn" name="isbn" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="ISBN">
                                                <span class="form-text">International Standard Book Number</span>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="mpn">MPN</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="mpn" name="mpn" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="mpn">
                                                <span class="form-text">Manufacturer Part Number</span>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Stock -->
                                    <section class="stock">
                                        <h4>Stock</h4><hr>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="stock_quantity">stock_Quantity</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="stock_quantity" name="stock_quantity" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Quantity">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="minimum_quantity">Minimum Quantity</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" id="minimum_quantity" name="minimum_quantity" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Minimum Quantity">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="stock_subtract">Subtract Stock</label>
                                            </div>
                                            <div class="col-10 form-check form-switch">
                                                <input class="form-check-input fs-3 m-0" id="stock_subtract" name="stock_subtract_status" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="input-stock-status">Out Of Stock Status</label>
                                            </div>
                                            <div class="col-10">
                                                <select name="stock_status_id" id="input-stock-status" class="form-select">
                                                    <option value="6" selected="">2-3 Days</option>
                                                    <option value="7">In Stock</option>
                                                    <option value="5">Out Of Stock</option>
                                                    <option value="8">Pre-Order</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="date_available">Date Available</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="date" id="date_available" name="date_available" class="w-25 p-2" value="{{ $social->instagram ?? '' }}">
                                            </div>
                                        </div>
                                    </section>
                                    <!-- Specification -->
                                    <section class="stock">
                                        <h4>Specification</h4><hr>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="shipping">Requires Shipping</label>
                                            </div>
                                            <div class="col-10 form-check form-switch">
                                                <input class="form-check-input fs-3 m-0" id="shipping" name="shipping" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label>Dimensions (L x W x H)</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="length" class="col p-2" value="{{ $social->instagram ?? '0.0000' }}">
                                                <input type="text" name="width" class="col p-2" value="{{ $social->instagram ?? '0.0000' }}">
                                                <input type="text" name="height" class="col p-2" value="{{ $social->instagram ?? '0.0000' }}">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="input-length-class">Length Class</label>
                                            </div>
                                            <div class="col-10">
                                                <select name="length_class_id" id="input-length-class" class="form-select">
                                                    <option value="1" selected="">Centimeter</option>
                                                    <option value="3">Inch</option>
                                                    <option value="2">Millimeter</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="weight">Weight</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="weight" id="weight" class="form-control col p-2" value="{{ $social->instagram ?? '0.0000' }}">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="input-weight-class">Weight Class</label>
                                            </div>
                                            <div class="col-10">
                                                <select name="weight_class_id" id="input-weight-class" class="form-select">
                                                    <option value="2">Gram</option>
                                                    <option value="1" selected="">Kilogram</option>
                                                    <option value="6">Ounce</option>
                                                    <option value="5">Pound </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="status">Status</label>
                                            </div>
                                            <div class="col-10 form-check form-switch">
                                                <input class="form-check-input fs-3 m-0" id="status" name="status" type="checkbox" role="switch">
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-2 text-end">
                                                <label for="sort_order">Sort Order</label>
                                            </div>
                                            <div class="col-10">
                                                <input type="text" name="sort_order" id="sort_order" class="form-control col p-2" value="{{ $social->instagram ?? '' }}" placeholder="Sort order">
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <!-- Price -->
                                <div class="tab-pane fade show" id="price" role="tabpanel" aria-labelledby="price-tab">
                                    <div class="mt-4"></div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="list_price">List Price</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="list_price" name="list_price" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="List Price">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="mrp">MRP</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="mrp" name="mrp" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="MRP">
                                        </div>
                                    </div>
                                </div>
                                <!-- Links -->
                                <div class="tab-pane fade show" id="links" role="tabpanel" aria-labelledby="links-tab">
                                    <div class="mt-4"></div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="manufacturer">Manufacturer</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="manufacturer" name="manufacturer" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Manufacturer">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label>Product set as a New</label>
                                        </div>
                                        <div class="col-10">
                                            Start Date <input type="date" name="start_date" class="w-25 me-5 p-2" value="{{ $social->instagram ?? '' }}">
                                            CLose Date <input type="date" name="close_date" class="w-25 p-2" value="{{ $social->instagram ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="categories">Categories</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="categories" name="categories" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Categories">
                                            <div class="form-control mt-1" style="height: 150px; overflow: auto;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="filter">Filters</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="filter" name="filter" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="filter">
                                            <div class="form-control mt-1" style="height: 150px; overflow: auto;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="download">Downloads</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="download" name="download" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Downloads">
                                            <div class="form-control mt-1" style="height: 150px; overflow: auto;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="related_product">Related Products</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="related_product" name="related_product" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Related Products">
                                            <div class="form-control mt-1" style="height: 150px; overflow: auto;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Attributes -->
                                <div class="tab-pane fade show" id="attribute" role="tabpanel" aria-labelledby="attribute-tab">
                                    <div class="mt-4"></div>
                                    <div class="col-sm-12 mb-4">
                                        <table class="table table-bordered table-hover center-align-table">
                                            <thead>
                                                <tr>
                                                    <th>Attribute</th>
                                                    <th>Text</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="attribute_name[]" class="form-control" placeholder="Attribue Name">
                                                    </td>
                                                    <td>
                                                        <textarea name="attribute_text[]" class="form-control" id="" rows="3" placeholder="Text"></textarea>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Remove"><i class="fa-solid fa-minus"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add"><i class="fa-solid fa-plus"></i></a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- Discount -->
                                <div class="tab-pane fade show" id="discount" role="tabpanel" aria-labelledby="discount-tab">
                                    <div class="mt-4"></div>
                                    <div class="col-sm-12 mb-4">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Customer Group</th>
                                                    <th>Quantity</th>
                                                    <th>Priority</th>
                                                    <th>Price</th>
                                                    <th>Date Start</th>
                                                    <th>Date End</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="product_discount[0][customer_group_id]" class="form-select">    
                                                            <option value="1">Default</option>  
                                                        </select>
                                                        <input type="hidden" class="form-control" name="product_discount[0][product_discount_id]" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="discount_quantity" id="discount_quantity" placeholder="Quantity">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="discount_priority" id="discount_priority" placeholder="Priority">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="discount_price" id="discount_price" placeholder="Price">
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" name="discount_start_date" id="discount_start_date">
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" name="discount_close_date" id="discount_close_date">
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Remove"><i class="fa-solid fa-minus"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6"></td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add"><i class="fa-solid fa-plus"></i></a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- Special -->
                                <div class="tab-pane fade show" id="special" role="tabpanel" aria-labelledby="special-tab">
                                    <div class="mt-4"></div>
                                    <div class="col-sm-12 mb-4">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Customer Group</th>
                                                    <th>Priority</th>
                                                    <th>Price</th>
                                                    <th>Date Start</th>
                                                    <th>Date End</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="product_discount[0][customer_group_id]" class="form-select">    
                                                            <option value="1">Default</option>  
                                                        </select>
                                                        <input type="hidden" class="form-control" name="special_discount[0][product_discount_id]" value="">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="special_priority" id="special_priority" placeholder="Priority">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="special_price" id="special_price" placeholder="Price">
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" name="special_start_date" id="special_start_date">
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control" name="special_close_date" id="special_close_date">
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Remove"><i class="fa-solid fa-minus"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5"></td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add"><i class="fa-solid fa-plus"></i></a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- Reward Points -->
                                <div class="tab-pane fade show" id="reward" role="tabpanel" aria-labelledby="reward-tab">
                                    <div class="mt-4"></div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="reward_point">Reward Points</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="reward_point" name="reward_point" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Reward Points">
                                        </div>
                                    </div>
                                </div>
                                <!-- Image -->
                                <div class="tab-pane fade show" id="image" role="tabpanel" aria-labelledby="image-tab">
                                    <div class="mt-4"></div>
                                    <div class="mb-4">
                                        <h4>Featured Image</h4><hr>
                                        <div class="col-sm-4 col-md-3">
                                            <div class="card p-2" style="width: 12rem">
                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgPbd2MBbw3o5_yzYC_pPjoVNKUx7WCrMN3g&s" alt="" class="card-img-top">
                                                <input type="hidden" name="image" value="catalog/black/IMG_6739.jpg" id="input-image">
                                                <div class="card-body text-center mt-2"> 
                                                    <button class="btn btn-primary fs-5 px-3" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fa-solid fa-pencil"></i></button>
                                                    <button class="btn btn-warning text-white fs-5 px-3" href="{{$back}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Clear"><i class="fa-regular fa-trash-can"></i></button>                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-4">
                                        <table class="table table-bordered table-hover center-align-table">
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Sort Order</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="col-sm-4 col-md-3">
                                                            <div class="card p-2" style="width: 12rem">
                                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgPbd2MBbw3o5_yzYC_pPjoVNKUx7WCrMN3g&s" alt="" class="card-img-top">
                                                                <input type="hidden" name="image" value="catalog/black/IMG_6739.jpg" id="input-image">
                                                                <div class="card-body text-center mt-2"> 
                                                                    <button class="btn btn-primary fs-5 px-3" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit"><i class="fa-solid fa-pencil"></i></button>
                                                                    <button class="btn btn-warning text-white fs-5 px-3" href="{{$back}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Clear"><i class="fa-regular fa-trash-can"></i></button>                                               
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </td>
                                                    <td>
                                                        <input type="text" id="image_sort_order" name="image_sort_order" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Sort Order">
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Remove"><i class="fa-solid fa-minus"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Add"><i class="fa-solid fa-plus"></i></a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <!-- Other Link -->
                                <div class="tab-pane fade show" id="other-link" role="tabpanel" aria-labelledby="other-link-tab">
                                    <div class="mt-4"></div>
                                    <h4>Other E-commerce URL</h4><hr>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="amazon_link">Amazon</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="amazon_link" name="amazon_link" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Amazon">
                                        </div>
                                        <div class="col-2 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="amazon_link_status" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="flipkart_url">Flipkart</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="flipkart_url" name="flipkart_url" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Flipkart">
                                        </div>
                                        <div class="col-2 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="flipkart_url_status" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="myntra_url">Myntra</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="myntra_url" name="myntra_url" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Myntra">
                                        </div>
                                        <div class="col-2 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="myntra_url_status" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="ajio_url">Ajio</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="ajio_url" name="ajio_url" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Ajio">
                                        </div>
                                        <div class="col-2 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="ajio_url_status" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-2 text-end">
                                            <label for="meesho_url">Meesho</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="meesho_url" name="meesho_url" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Meesho">
                                        </div>
                                        <div class="col-2 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="meesho_url_status" type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection