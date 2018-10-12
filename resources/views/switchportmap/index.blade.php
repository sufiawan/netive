@extends('layouts.app')

@section('content')
    <!-- <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Network Devices</a></li>
            <li class="breadcrumb-item active" aria-current="page">Access Point</li>
        </ol>
    </nav> -->
    <div class="pb-2 mb-2"><h2>Switch Port Map</h2></div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">

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
