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
                                            <a class="btn btn-outline-primary" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Refresh"><i class="fa-solid fa-rotate"></i></a>
                                            <a class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Image Upload"><i class="fa-solid fa-upload"></i></a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
