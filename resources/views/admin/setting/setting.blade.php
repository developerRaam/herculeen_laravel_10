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
                        <button id="submitButton" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Save">Save</button>
                    </div>
                </div>
            </div>
            
            <div class="row g-3 px-4">
                <div class="col-md-12">
                    <!-- Alert Message -->
                    @include('admin.common.alert')
                    
                    <div class="card rounded-0 p-5">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="social_medias-tab" data-bs-toggle="tab" data-bs-target="#social_medias" type="button" role="tab" aria-controls="social_medias" aria-selected="false">Social Media</button>
                            </li>
                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="address-tab" data-bs-toggle="tab" data-bs-target="#address" type="button" role="tab" aria-controls="address" aria-selected="false">Address</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
                            </li>
                        </ul>
                        <form action="{{ route('admin-setting') }}" id="myForm" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="social_medias" role="tabpanel" aria-labelledby="social_medias-tab">
                                <div class="mt-4">
                                    <div class="row mb-3">
                                        <div class="col-2 text-center">
                                            <label for="instagram">Instagram</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="instagram" name="instagram" class="form-control p-2" value="{{ $social->instagram ?? '' }}" placeholder="Enter Instagram URL">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2 text-center">
                                            <label for="facebook">Facebook</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="facebook" name="facebook" class="form-control p-2" value="{{ $social->facebook ?? '' }}" placeholder="Enter Facebook URL">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2 text-center">
                                            <label for="youtube">YouTube</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="youtube" name="youtube" class="form-control p-2" value="{{ $social->youtube ?? '' }}" placeholder="Enter YouTube URL">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2 text-center">
                                            <label for="youtube">Status</label>
                                        </div>
                                        <div class="col-2 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="social_status" @if ($social->status) checked @endif type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                <div class="mt-4">
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label for="address">Address</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="address" name="address" class="form-control p-2" value="{{$address->address ?? ''}}" placeholder="Enter address">
                                        </div>
                                        <div class="col-1 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="address_status" type="checkbox" @if ($address->address_status) checked @endif role="switch">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label for="embed_url">Embed Address URL</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="embed_url" name="embed_url" class="form-control p-2" value="{{$address->embed_url ?? ''}}" placeholder="Enter address embed url">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label for="mobile">Mobile</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" id="mobile" name="mobile" class="form-control p-2" value="{{$address->mobile ?? ''}}" placeholder="Enter mobile">
                                        </div>
                                        <div class="col-1 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="mobile_status" @if ($address->mobile_status) checked @endif type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label for="whatsapp_number">Whatsapp Number</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="number" id="whatsapp_number" name="whatsapp_number" class="form-control p-2" value="{{$address->whatsapp_number ?? ''}}" placeholder="Enter whatsapp_number">
                                        </div>
                                        <div class="col-1 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="whatsapp_number_status" @if ($address->whatsapp_number_status) checked @endif type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="email" name="email" class="form-control p-2" value="{{$address->email ?? ''}}" placeholder="Enter email">
                                        </div>
                                        <div class="col-1 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="email_status" @if ($address->email_status) checked @endif type="checkbox" role="switch">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label for="website">Website</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="text" id="website" name="website" class="form-control p-2" value="{{$address->website ?? ''}}" placeholder="Enter website">
                                        </div>
                                        <div class="col-1 form-check form-switch">
                                            <input class="form-check-input fs-3 ms-3" name="website_status" @if ($address->website_status) checked @endif type="checkbox" role="switch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="mt-4">
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label for="site_name">Site Name</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="site_name" name="site_name" class="form-control p-2" placeholder="Enter Site Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label for="logo">Logo</label>
                                        </div>
                                        <div class="col-10">
                                            <input type="text" id="logo" name="logo" class="form-control p-2">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-2">
                                            <label for="site_description">Site Description</label>
                                        </div>
                                        <div class="col-10">
                                            <textarea name="site_description" id="site_description" class="form-control p-2" rows="3" placeholder="Enter Site Description"></textarea>
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
        document.addEventListener("DOMContentLoaded", function() {
            let submitButton = document.getElementById("submitButton");
            let form = document.getElementById("myForm");

            submitButton.addEventListener("click", function() {
                form.submit(); // This will submit the form when the button is clicked
            });
        });
    </script>
    
</section>
@endsection