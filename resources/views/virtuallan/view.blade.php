@extends('layouts.app')

@section('content')    
    <div class="pb-2 mb-2"><h2>Client List - {{ $data->name }}</h2></div>
    <div class="card">
        <div class="card-body">            
            <div class="table-responsive">
                <table id="tbldata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>IP Address</th>
                            <th>Device</th>
                            <th>Connect To</th>
                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->ip_address }}</td>
                            <td>                                                                
                                @if (!is_null($client->linked_device))
                                    {{ $client->linked_device->connected_device_type->name }}
                                    @if($client->linked_device->connected_device_type->id == 8)
                                        {{ ' | '.$client->linked_device->connected_device->name }}
                                    @else
                                        {{ ' | '.$client->linked_device->connected_device->brand_type }}
                                    @endif
                                @else
                                    Virtual Server
                                @endif
                            </td>
                            <td><a href='/networkswitch/{{ $client->linked_device->network_switch->id }}'>{{ $client->linked_device->network_switch->network_device->brand_type }} | Port : {{ $client->linked_device->port_number }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">            
                    <a href="/virtuallan" class="btn btn-secondary">Back</a>
                </div>
            </div> 
        </div>        
    </div>
    

    <script type="text/javascript">        
        $(document).ready( function () {
            $('#tbldata').DataTable();
        });
    </script>
@endsection
