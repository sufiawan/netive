@extends('layouts.app')

@section('content')
<div class="pb-2 mb-2"><h2>Server</h2></div>
<div class="card">
    <div class="card-body">
        @if($data->id)
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#general">General</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#vs">Virtual Server</a>
            </li>                
        </ul>
        @endif
        <div class="tab-content" id="myTabContent">            
            <div class="tab-pane show active mb-1" id="general">
                <div class="card-header mb-2">General Information</div>
                <div class="form">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            {{ Form::label('name', 'Name') }}
                            <input id="name" type="text" class="form-control" name="name" value="{{ $data->name }}" readonly>                        
                        </div>                    
                    </div>

                    @include('inc.deviceview')

                    <div class="card-header mb-2">Technical Specification</div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            {{ Form::label('cpu', 'Processor') }}
                            <input id="cpu" type="text" class="form-control" name="cpu" value="{{ $data->cpu }}" readonly>                        
                        </div>
                        <div class="form-group col-md-2">
                            {{ Form::label('cpu_core', 'CPU Core') }}
                            <input id="cpu_core" type="number" class="form-control" name="cpu_core" value="{{ $data->cpu_core }}"  readonly>                        
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('hdd', 'Harddisk') }}
                            <input id="hdd" type="text" class="form-control" name="hdd" value="{{ $data->hdd }}" readonly>                        
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('hdd_capacity', 'HDD Capacity') }}
                            <div class="input-group mb-3">                
                                <input id="hdd_capacity" type="number" class="form-control" name="hdd_capacity" value="{{ $data->hdd_capacity }}" readonly>    					
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">GB</span>
                                </div>
                            </div>					
                            <small class="form-text text-muted">(decimal) 1 TB = 1000 GB</small>                        
                        </div>                
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            {{ Form::label('ram', 'RAM') }}
                            <input id="ram" type="text" class="form-control" name="ram" value="{{ $data->ram }}" readonly>                        
                        </div>
                        <div class="form-group col-md-3">
                            {{ Form::label('ram_capacity', 'RAM Capacity') }}
                            <div class="input-group mb-3">                
                                <input id="ram_capacity" type="number" class="form-control" name="ram_capacity" value="{{ $data->ram_capacity }}" readonly>    					
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">GB</span>
                                </div>
                            </div>					                                      
                        </div>   
                        <div class="form-group col-md-6">
                            {{ Form::label('os', 'Operating System') }}
                            <input id="os" type="text" class="form-control" name="os" value="{{ $data->os }}" readonly>
                        </div>
                    </div>                           
                </div>
            </div>
            <div class="tab-pane" id="vs">                
                <table id="tbldata" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>CPU Core</th>
                            <th>RAM Capacity</th>
                            <th>HDD Capacity</th>
                            <th>Operating System</th>
                            <th>IP Address</th>                                                            
                        </tr>
                        @csrf
                    </thead>
                    <tbody>                            
                        @foreach($data->virtualserver as $vs)
                        <tr>
                            <td>{{ $vs->name }}</td>
                            <td>{{ $vs->cpu_core }}</td>
                            <td>{{ $vs->ram }} GB</td>
                            <td>{{ $vs->hdd }} GB</td>
                            <td>{{ $vs->os }}</td>
                            <td>{{ $vs->ip_address }}</td>                            
                        </tr>
                        @endforeach                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card-body">
        <a href="/server" class="btn btn-secondary">Back</a>        
    </div> 
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#tbldata').DataTable();
    });
</script>
@endsection
