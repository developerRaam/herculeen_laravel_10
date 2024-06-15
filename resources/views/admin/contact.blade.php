@extends('admin.common.base')

@push('setTitle')
    Enquiry
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
                <div class="admin-title">
                    <h2>Enquiry</h2>
                </div>
            </div>
            <div class="px-4">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($contacts)
                        @foreach ($contacts as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->number}}</td>
                            <td>{{$item->message}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>Edit</td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
               </table>
            </div>
        </div>
    </div>
</section>
@endsection