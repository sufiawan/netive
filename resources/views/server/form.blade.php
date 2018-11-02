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
                @if($data->id)
                {!! Form::open(['route' => ['server.update', $data->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
                @else
                {!! Form::open(['route' => 'server.store']) !!}
                @endif
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('name', 'Name') }}
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $data->name) }}" placeholder="name" required>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('brand_type', 'Brand & Type') }}
                        <input id="brand_type" type="text" class="form-control{{ $errors->has('brand_type') ? ' is-invalid' : '' }}" name="brand_type" value="{{ old('brand_type', $data->brand_type) }}" placeholder="brand & type" required>
                        @if ($errors->has('brand_type'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('brand_type') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        {{ Form::label('bmn_number', 'BMN Number') }}
                        <input id="bmn_number" type="text" class="form-control" name="bmn_number" value="{{ old('bmn_number', $data->bmn_number) }}" placeholder="bmn number">
                    </div>
                    <div class="form-group col-md-2">
                        {{ Form::label('purchase_year', 'Purchase Year') }}
                        <input id="purchase_year" type="number" class="form-control{{ $errors->has('purchase_year') ? ' is-invalid' : '' }}" name="purchase_year" value="{{ old('purchase_year', $data->purchase_year) }}" placeholder="purchase year" required>
                        @if ($errors->has('purchase_year'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('purchase_year') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('ip_address', 'IP Address') }}
                        <input id="ip_address" type="text" class="form-control{{ $errors->has('ip_address') ? ' is-invalid' : '' }}" name="ip_address" value="{{ old('ip_address', $data->ip_address) }}" placeholder="ip address" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}">
                        @if ($errors->has('ip_address'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ip_address') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('device_username', 'Device Username') }}
                        <input id="device_username" type="text" class="form-control{{ $errors->has('device_username') ? ' is-invalid' : '' }}" name="device_username" value="{{ old('device_username', $data->device_username) }}"  placeholder="device username" required>
                        @if ($errors->has('device_username'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('device_username') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('device_password', 'Device Password') }}
                        <input id="device_password" type="text" class="form-control{{ $errors->has('device_password') ? ' is-invalid' : '' }}" name="device_password" value="{{ old('device_password', $data->device_password) }}" placeholder="device password" required>
                        @if ($errors->has('device_password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('device_password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="card-header mb-2">Technical Specification</div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        {{ Form::label('cpu', 'Processor') }}
                        <input id="cpu" type="text" class="form-control{{ $errors->has('cpu') ? ' is-invalid' : '' }}" name="cpu" value="{{ old('cpu', $data->cpu) }}"  placeholder="processor" required>
                        @if ($errors->has('cpu'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cpu') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-2">
                        {{ Form::label('cpu_core', 'CPU Core') }}
                        <input id="cpu_core" type="number" class="form-control{{ $errors->has('cpu_core') ? ' is-invalid' : '' }}" name="cpu_core" value="{{ old('cpu_core', $data->cpu_core) }}"  placeholder="core" required>
                        @if ($errors->has('cpu_core'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cpu_core') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        {{ Form::label('hdd', 'Harddisk') }}
                        <input id="hdd" type="text" class="form-control{{ $errors->has('hdd') ? ' is-invalid' : '' }}" name="hdd" value="{{ old('hdd', $data->hdd) }}" placeholder="harddisk" required>
                        @if ($errors->has('hdd'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('hdd') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        {{ Form::label('hdd_capacity', 'HDD Capacity') }}
                        <div class="input-group mb-3">                
                            <input id="hdd_capacity" type="number" class="form-control{{ $errors->has('hdd_capacity') ? ' is-invalid' : '' }}" name="hdd_capacity" value="{{ old('hdd_capacity', $data->hdd_capacity) }}"  placeholder="capacity" required>    					
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">GB</span>
                            </div>
                        </div>					
                        <small class="form-text text-muted">(decimal) 1 TB = 1000 GB</small>
                        @if ($errors->has('hdd_capacity'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('hdd_capacity') }}</strong>
                        </span>
                        @endif           
                    </div>                
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        {{ Form::label('ram', 'RAM') }}
                        <input id="ram" type="text" class="form-control{{ $errors->has('ram') ? ' is-invalid' : '' }}" name="ram" value="{{ old('ram', $data->ram) }}"  placeholder="ram" required>
                        @if ($errors->has('ram'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ram') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-3">
                        {{ Form::label('ram_capacity', 'RAM Capacity') }}
                        <div class="input-group mb-3">                
                            <input id="ram_capacity" type="number" class="form-control{{ $errors->has('ram_capacity') ? ' is-invalid' : '' }}" name="ram_capacity" value="{{ old('ram_capacity', $data->ram_capacity) }}"  placeholder="capacity" required>    					
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">GB</span>
                            </div>
                        </div>					
                        @if ($errors->has('ram_capacity'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ram_capacity') }}</strong>
                        </span>
                        @endif                  
                    </div>   
                    <div class="form-group col-md-6">
                        {{ Form::label('os', 'Operating System') }}
                        <input id="os" type="text" class="form-control" name="os" value="{{ old('os', $data->os) }}" placeholder="operating system" required>                    
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="/server" class="btn btn-secondary">Back</a>
                    </div>
                </div>        
                {!! Form::close() !!}
            </div>
            <div class="tab-pane" id="vs">
                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#modalVS">Add New</button>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>CPU Core</th>
                            <th>RAM Capacity</th>
                            <th>HDD Capacity</th>
                            <th>Operating System</th>
                            <th>IP Address</th>                                
                            <th>Action</th>
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
                            <td><div><button type="button" class="btn btn-sm btn-primary mr-1">Edit</button><button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $vs->id }});">Delete</button></div></td>
                        </tr>
                        @endforeach                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalVS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Virtual Server</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{ Form::label('vs_name', 'Name') }}
                            <input id="vs_name" type="text" class="form-control{{ $errors->has('vs_name') ? ' is-invalid' : '' }}" name="vs_name" value="{{ old('vs_name', $vs->vs_name) }}"  placeholder="name" required>
                            @if ($errors->has('vs_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('vs_name') }}</strong>
                            </span>
                            @endif
                        </div>                                                
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            {{ Form::label('cpu_core', 'CPU Core') }}
                            <input id="cpu_core" type="number" class="form-control{{ $errors->has('cpu_core') ? ' is-invalid' : '' }}" name="cpu_core" value="{{ old('cpu_core', $data->cpu_core) }}"  placeholder="core" required>
                            @if ($errors->has('cpu_core'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('cpu_core') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-5">
                            {{ Form::label('vs_ram_capacity', 'RAM Capacity') }}
                            <div class="input-group mb-3">                
                                <input id="vs_ram_capacity" type="number" class="form-control{{ $errors->has('hdd_capacity') ? ' is-invalid' : '' }}" name="hdd_capacity" value="{{ old('hdd_capacity', $data->hdd_capacity) }}"  placeholder="capacity" required>    					
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">GB</span>
                                </div>
                            </div>					
                            <small class="form-text text-muted">(decimal) 1 TB = 1000 GB</small>
                            @if ($errors->has('hdd_capacity'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('hdd_capacity') }}</strong>
                            </span>
                            @endif           
                        </div>
                        <div class="form-group col-md-5">
                            {{ Form::label('vs_hdd_capacity', 'HDD Capacity') }}
                            <div class="input-group mb-3">                
                                <input id="hdd_capacity" type="number" class="form-control{{ $errors->has('hdd_capacity') ? ' is-invalid' : '' }}" name="hdd_capacity" value="{{ old('hdd_capacity', $data->hdd_capacity) }}"  placeholder="capacity" required>    					
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">GB</span>
                                </div>
                            </div>					
                            <small class="form-text text-muted">(decimal) 1 TB = 1000 GB</small>
                            @if ($errors->has('hdd_capacity'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('hdd_capacity') }}</strong>
                            </span>
                            @endif           
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{ Form::label('vs_os', 'Operating System') }}
                            <input id="vs_name" type="text" class="form-control{{ $errors->has('vs_os') ? ' is-invalid' : '' }}" name="vs_os" value="{{ old('vs_os', $vs->vs_os) }}"  placeholder="operating system" required>
                            @if ($errors->has('vs_os'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('vs_os') }}</strong>
                            </span>
                            @endif
                        </div>                                                
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection
