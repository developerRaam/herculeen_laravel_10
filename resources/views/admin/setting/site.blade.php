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
                        <p class="mb-0"><i class="fa-solid fa-pencil"></i> Site</p>
                    </div>
                    <div class="card rounded-0 p-3 mb-3 ">
                        <form id="saveForm" action="{{$action}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-2 text-end">
                                    <label for="site_title">Site Title</label>
                                </div>
                                <div class="col-10">
                                    <input type="text" id="site_title" name="site_title" class="form-control p-2" value="{{ isset($site_title) ? $site_title: old('site_title') }}" placeholder="Site Title">
                                </div>
                                <div class="errors">
                                    <span class="text-danger">
                                        @error('site_title')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-2 text-end">
                                    <label for="site_logo">Site Logo</label>
                                </div>
                                <div class="col-10">
                                    <div class="card p-2" style="width: 12rem">
                                        @if(isset($site_logo) && $site_logo)
                                            <img src="{{ asset('image/setting/site/' . $site_logo) }}" alt="Category Image" class="card-img-top" id="imagePreview" onclick="triggerFileUpload()">
                                        @else
                                            <img src="{{ asset('image/not-image-available.png') }}" alt="No Image Available" class="card-img-top" id="imagePreview" onclick="triggerFileUpload()">
                                        @endif
                                        <input type="file" name="site_logo" id="imageUpload" accept="image/*" style="display: none;" onchange="previewImage(event)">
                                        <div class="card-body text-center mt-1"> 
                                            <button type="button" class="btn btn-danger fs-5 px-3" onclick="removeImage()" data-bs-toggle="tooltip" data-bs-placement="top" title="Clear"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="errors">
                                    <span class="text-danger">
                                        @error('site_logo')
                                            {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-2 text-end">
                                    <label for="site_description">Site Description</label>
                                </div>
                                <div class="col-10">
                                    <textarea name="site_description" id="site_description" class="form-control p-2" rows="5">
                                        {{ isset($site_description) ? $site_description : old('site_description') }}
                                    </textarea>
                                </div>
                                <div class="errors">
                                    <span class="text-danger">
                                        @error('site_description')
                                            {{$message}}
                                        @enderror
                                    </span>
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