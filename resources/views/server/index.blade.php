@extends('layouts.app')

@section('content')
    <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Network Devices</a></li>
            <li class="breadcrumb-item active" aria-current="page">Access Point</li>
        </ol>
    </nav> -->
    <div class="pb-2 mb-2"><h2>Server</h2></div>
    <div class="card">
        <div class="card-body">
            @if (Auth::user()->role->name == 'Administrator')
            <div class="card-title">
                <a href="/server/create" class="btn btn-primary">Create</a>
            </div>
            @endif
            <div class="table-responsive">
                <table id="tbldata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Brand & Type</th>
                            <th>BMN Number</th>
                            <th>Purchase Year</th>
                            <th>Virtual Server</th>
                            <th>Action</th>
                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach($listdata as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->network_device->brand_type }}</td>
                            <td>{{ $data->network_device->bmn_number }}</td>
                            <td>{{ $data->network_device->purchase_year }}</td>
                            <td>{{ $data->virtualserver->count() }}</td>
                            <td>                                
                                @if (Auth::user()->role->name == 'Administrator')
                                <a href="/server/{{ $data->id }}/edit" class="btn btn-sm btn-primary mr-1">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $data->id }});">Delete</button>
                                @else
                                <a href="/server/{{ $data->id }}" class="btn btn-sm btn-success mr-1">View</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form id="delete-form" action="/" method="POST" style="display: none;">@csrf {{ Form::hidden('_method', 'DELETE') }}</form>

    <script type="text/javascript">
        function confirmDelete(id) {
            bootbox.confirm("Are you sure want to delete?", function(result) {
                if (result) {
                    $('#delete-form').attr('action', '/server/' + id);
                    $('#delete-form').submit();
                }
            })
        }

        $(document).ready( function () {
            $('#tbldata').DataTable();
        });
    </script>
@endsection
