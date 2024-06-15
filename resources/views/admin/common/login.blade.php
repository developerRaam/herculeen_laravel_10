@extends('admin.common.base')

@push('setTitle')
    Dashboard
@endpush

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height:100vh">
        <div class="col-11 col-sm-6 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="fs-4 mb-4 text-center">Admin Login</h2>
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('admin-login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" class="form-control p-2" name="username" id="username" placeholder="Username">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control p-2" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="form-group mb-3">
                            <input type="submit" class="btn btn-primary form-control p-2" name="submit" value="Login">
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>
    @endsection