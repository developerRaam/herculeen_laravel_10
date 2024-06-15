@extends('admin.common.base')

@push('setTitle')
    Demo data table
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
                    <h2>Demo data table</h2>
                </div>
            </div>
            <div class="px-4">
                <table id="myTable" class="display">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Firm Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($registerWholesaler)
                        @foreach ($registerWholesaler as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->firm_name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->number}}</td>
                            <td>{{$item->created_at}}</td>
                            <td><button data-id="{{$item->id}}" class="border-0 button-view" data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa-solid fa-eye text-primary fs-4"></i></button></td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
               </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="myModalLabel">View Wholsaler</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <table class="table">
                <tbody class="showData"></tbody>
            </table>
            </div>
        </div>
        </div>
    </div>

    <script>
        let buttons = document.querySelectorAll('.button-view');
        let wholesalerData = @json($registerBrand) ?? ''; // Convert PHP array to JSON
    
        buttons.forEach(element => {
            element.addEventListener('click', function() {
                let id = element.getAttribute('data-id');

                // Find the data associated with the clicked ID
                let data = wholesalerData.find(item => item.id == id);
    
                if (data) {
                    let html = '<tr>';
                        html += '<th>Name</th>';
                        html += '<td>'+data.name+'</td>';
                        html += '</tr>';

                        html += '<tr>';
                        html += '<th>Firm Name</th>';
                        html += '<td>'+data.firm_name+'</td>';
                        html += '</tr>';

                        html += '<tr>';
                        html += '<th>Address</th>';
                        html += '<td>'+data.address+'</td>';
                        html += '</tr>';

                        html += '<tr>';
                        html += '<th>Number</th>';
                        html += '<td>'+data.number+'</td>';
                        html += '</tr>';

                        html += '<tr>';
                        html += '<th>Email</th>';
                        html += '<td>'+data.email+'</td>';
                        html += '</tr>';

                        html += '<tr>';
                        html += '<th>Website</th>';
                        html += '<td>'+data.website+'</td>';
                        html += '</tr>';

                        html += '<tr>';
                        html += '<th>Message</th>';
                        html += '<td>'+data.message+'</td>';
                        html += '</tr>';

                        html += '<tr>';
                        html += '<th>Date</th>';
                        html += '<td>'+data.created_at+'</td>';
                        html += '</tr>';

                        document.querySelector('.showData').innerHTML = html;
                } else {
                    console.error('Data not found for ID: ' + id);
                }
            });
        });
    </script>
    
</section>
@endsection