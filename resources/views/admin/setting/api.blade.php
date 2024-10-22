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
                    
                    <div class="px-3 py-2 title-list">
                        <p class="mb-0"><i class="fa-solid fa-pencil"></i> API</p>
                    </div>
                    <div class="card rounded-0 p-3 mb-3 ">
                        <form id="saveForm" action="{{$action}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-2 text-end">
                                    <label for="api_apiKey">API Key</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="api_apiKey" name="api_apiKey" class="form-control p-2" value="{{ isset($apiKey) ? $apiKey: old('api_apiKey') }}" placeholder="API Key">
                                </div>
                                <div class="errors">
                                    <span class="text-danger">
                                        @error('api_apiKey')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-2 text-end">
                                    <label for="api_apiPassword">API Password</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="api_apiPassword" name="api_apiPassword" class="form-control p-2" value="{{ isset($apiPassword) ? $apiPassword: old('api_apiPassword') }}" placeholder="API Password">
                                </div>
                                <div class="errors">
                                    <span class="text-danger">
                                        @error('api_apiPassword')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-2 text-end">
                                    <label for="api_status">Status</label>
                                </div>
                                <div class="col-10 form-check form-switch">
                                    <input type="hidden" name="api_status" value="0">
                                    <input class="form-check-input fs-3 m-0" id="api_status" name="api_status" type="checkbox" value="1" @if($api_status) checked @endif role="switch" >
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
            let form = document.getElementById("saveForm");

            submitButton.addEventListener("click", function() {
                form.submit(); // This will submit the form when the button is clicked
            });
        });

        // for desktop
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
            document.getElementById(`imagePreview`).src = "{{ asset('not-image-available.png')}}";
        }

        // for mobile
        function previewImageMobile(event) {
            const input = event.target;
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById(`imagePreviewMobile`);
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        function triggerFileUploadMobile(index) {
            document.getElementById(`imageUploadMobile`).click();
        }

        function removeImageMobile() {
            document.getElementById('imageUploadMobile').value = '';
            document.getElementById(`imagePreviewMobile`).src = "{{ asset('not-image-available.png')}}";
        }
    </script>
    
</section>
@endsection