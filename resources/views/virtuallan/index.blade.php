@extends('layouts.app')

@section('content')
    <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Network Devices</a></li>
            <li class="breadcrumb-item active" aria-current="page">Access Point</li>
        </ol>
    </nav> -->
    <div class="pb-2 mb-2"><h2>Virtual LAN</h2></div>
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <a href="/virtuallan/create" class="btn btn-primary">Create</a>
            </div>
            <div class="table-responsive">
                <table id="tbldata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>IP Segment</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach($listdata as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->ip_segment }}</td>
                            <td>{{ $data->description }}</td>
                            <td><div><a href="/virtuallan/{{ $data->id }}/edit" class="btn btn-sm btn-primary mr-1">Edit</a><button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $data->id }});">Delete</button></div></td>
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
                    $('#delete-form').attr('action', '/virtuallan/' + id);
                    $('#delete-form').submit();
                }
            })
        }

        $(document).ready( function () {
            $('#tbldata').DataTable();
        });
    </script>
@endsection
