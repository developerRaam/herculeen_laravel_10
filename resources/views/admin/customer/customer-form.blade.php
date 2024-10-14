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
                        <button class="btn btn-primary fs-4 px-3" data-bs-toggle="tooltip" id="submitButton" data-bs-placement="top" data-bs-title="Save"><i class="fa-solid fa-floppy-disk"></i></button>
                        <a class="btn btn-primary fs-4 px-3" href="{{$back}}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Back"><i class="fa-solid fa-reply"></i></a>
                    </div>
                </div>
            </div>
            <div class="row g-3 px-4">
                <div class="col-sm-12">
                    <!-- Alert Message -->
                    @include('admin.common.alert')

                    <div class="px-3 py-2 title-list">
                        <p class="mb-0"><i class="fa-solid fa-pencil"></i> Add Customer</p>
                    </div>

                    <div class="card rounded-0 p-3 mb-3">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="false">General</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">Address</button>
                            </li>
                        </ul>

                        <!-- Tab content -->
                        <form action="{{$action}}" id="saveForm" method="post" enctype="multipart/form-data" class="pt-3">
                            @csrf
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="row mb-4">
                                                <div class="col-3 text-end">
                                                    <label for="customer_group_id">Customer Group</label>
                                                </div>
                                                <div class="col-9">
                                                    <select id="customer-dropdown" name="customer_group_id" class="form-control">
                                                        <option value="0">Default</option>
                                                    </select> 
                                                    <div>
                                                        <span class="text-danger">
                                                            @error('customer_group_id')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mb-4">
                                                <div class="col-3 text-end">
                                                    <label for="customer_name">Customer Name</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" id="customer_name" name="customer_name" class="form-control p-2" value="{{ isset($customer) && property_exists($customer, 'customer_name') ? $customer->customer_name : old('customer_name') }}" placeholder="customer Name">
                                                    <div>
                                                        <span class="text-danger">
                                                            @error('customer_name')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="row mb-4">
                                                <div class="col-3 text-end">
                                                    <label for="email">Email</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="email" id="email" name="email" class="form-control p-2" value="{{ isset($customer) && property_exists($customer, 'email') ? $customer->email : old('email') }}" placeholder="Email">
                                                    <div>
                                                        @if(Session::has('email_error'))
                                                            <div id="flash-message" class="alert alert-danger alert-dismissible fade show mt-2 p-1" role="alert">
                                                                {{ Session::get('email_error') }}
                                                                <button type="button" class="btn-close p-0 mt-2 me-2" style="font-size:11px" data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                        @endif
                                                        <span class="text-danger">
                                                            @error('email')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="row mb-4">
                                                <div class="col-3 text-end">
                                                    <label for="number">Contact</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="number" id="number" name="number" class="form-control p-2" value="{{ isset($customer) && property_exists($customer, 'number') ? $customer->number : old('number') }}" placeholder="Number">
                                                    <div>
                                                        <span class="text-danger">
                                                            @error('number')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="row mb-4">
                                                <div class="col-3 text-end">
                                                    <label for="password">Password</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="password" id="password" name="password" class="form-control p-2" value="{{ isset($customer) && property_exists($customer, 'password') ? $customer->password : old('password') }}" placeholder="Password">
                                                    <div>
                                                        <span class="text-danger">
                                                            @error('password')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="row mb-4">
                                                <div class="col-3 text-end">
                                                    <label for="confirm_password">Confirm Password</label>
                                                </div>
                                                <div class="col-9">
                                                    <input type="text" id="confirm_password" name="confirm_password" class="form-control p-2" value="{{ isset($customer) && property_exists($customer, 'confirm_password') ? $customer->confirm_password : old('confirm_password') }}" placeholder="Confirm Password">
                                                    <div>
                                                        <span class="text-danger">
                                                            @error('confirm_password')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="row mb-4">
                                                <div class="col-3 text-end">
                                                    <label for="status">Status</label>
                                                </div>
                                                <div class="col-9 form-check form-switch">
                                                    <input type="hidden" name="status" value="0">
                                                    <input class="form-check-input fs-3 m-0" id="status" name="status" type="checkbox" role="switch" value="1" {{ isset($customer) && property_exists($customer, 'status') ? (($customer->status) ? 'checked': '') : old('status') }}>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="row mb-4">
                                                <div class="col-3 text-end">
                                                    <label for="image">Image</label>
                                                </div>
                                                <div class="col-9">
                                                    <div class="card p-2" style="width: 12rem">
                                                        <img src="{{ isset($customer->image) ? asset('image/customer/'.$customer->image) : asset('image/not-image-available.png')}}" alt="Customer Image" class="card-img-top" id="imagePreview"  onclick="triggerFileUpload()">
                                                        <input type="file" name="image" id="imageUpload" accept="image/*" style="display: none;" onchange="previewImage(event)">
                                                        <div class="card-body text-center mt-1"> 
                                                            <button type="button" class="btn btn-danger fs-5 px-3" onclick="removeImage()" data-bs-toggle="tooltip" data-bs-placement="top" title="Clear"><i class="fa-solid fa-trash"></i></button>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <span class="text-danger">
                                                            @error('image')
                                                                {{$message}}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
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
    <script>

        // Form save 
        document.addEventListener("DOMContentLoaded", function() {
            let submitButton = document.getElementById("submitButton");
            let form = document.getElementById("saveForm");

            submitButton.addEventListener("click", function() {
                form.submit(); // This will submit the form when the button is clicked
            });
        });

        function previewImage(event) {
            const input = event.target;
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(`imagePreview`);
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        function triggerFileUpload(index) {
            document.getElementById(`imageUpload`).click();
        }

        function removeImage() {
            document.getElementById('imageUpload').value = '';
            document.getElementById(`imagePreview`).src = "{{ asset('image/not-image-available.png')}}";
        }

    </script>
</section>
@endsection