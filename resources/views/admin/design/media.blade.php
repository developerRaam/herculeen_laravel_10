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
                            <button id="image_manager" class="btn btn-primary fs-5 px-3" type="button" data-bs-toggle="modal"data-bs-target="#imageModal"><i class="fa-solid fa-upload" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Image Upload"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageManagerModal" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 60rem">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="imageManagerModal">Image Manager</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div>
                                            <a class="btn btn-outline-primary" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Parent"><i class="fa-solid fa-level-up-alt"></i></a>
                                            <button class="btn btn-outline-primary px-3" id="refresh" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Refresh"><i class="fa-solid fa-rotate"></i></button>
                                            <button class="btn btn-primary px-3" id="button-upload" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Image Upload"><i class="fa-solid fa-upload"></i></button>
                                            <input type="file" id="file-input" style="display: none;" multiple>
                                            <a class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="New Folder"><i class="fa-solid fa-folder"></i></a>
                                            <a class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete"><i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <input type="text" name="search" value="" placeholder="Search.." id="input-search" class="form-control">
                                            <button type="button" id="button-search" data-bs-toggle="tooltip" title="Search" class="btn btn-primary px-3"><i class="fa-solid fa-search"></i></button>
                                        </div>
                                    </div>
                                </div><hr>
                                <div class="row g-4" id="getAllUploads"></div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

        document.getElementById('image_manager').addEventListener('click', function() {
            getFiles();
        });

        document.getElementById('refresh').addEventListener('click', function() {
            getFiles();
        });

        document.getElementById('button-upload').addEventListener('click', function() {
            document.getElementById('file-input').click();
        });

        document.getElementById('file-input').addEventListener('change', function() {
            uploadFiles(this.files)
            getFiles();
        });

        function uploadFiles(files) {
            let formData = new FormData();
            // Append each file to FormData
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }
            // Append CSRF token
            formData.append('_token', '{{ csrf_token() }}');
            // Use jQuery AJAX to send FormData to Laravel endpoint
            $.ajax({
                url: "/admin/media/uploadFile",
                type: "POST",
                data: formData,
                contentType: false, // Don't set contentType
                processData: false, // Don't process data
                success: function (response) {
                    alert('Files uploaded successfully')
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // console.error(textStatus, errorThrown); // Handle errors
                    alert('Files uploaded Failed')
                }
            });
        }

        function getFiles(){
            let getAllUploads = document.getElementById('getAllUploads');
            $.ajax({
                url: "/admin/media/getFiles",
                type: "get",
                success: function (response) {
                    getAllUploads.innerHTML = '';
                    response.forEach(element => {
                    let html = '';
                        html += '<div class="col-sm-3 col-md-2">';
                        html += '<div class="card p-2" style="min-height:150px;display: flex;justify-content: center;">';
                        html += '<a href="'+element+'">';
                        html += '<img src="'+element+'" alt="'+element+'" class="card-img-top" style="vertical-align: middle;">';
                        html += '</a>';              
                        html += '</div>';
                        html += '</div>';
                    getAllUploads.innerHTML += html;
                   });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown); // Handle errors
                }
            });
        }

    </script>
@endsection
