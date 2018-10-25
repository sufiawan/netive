@extends('layouts.app')

@section('content')
    <div class="pb-2 mb-2"><h2>Core Switch</h2></div>    
	<div class="card">
		<div class="card-body">
            @if($data->id)
    		<ul class="nav nav-tabs mb-3">
        		<li class="nav-item">
            		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#general">General</a>
        		</li>
                
            	<li class="nav-item">
            		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#port">Port</a>
        		</li>                
        	</ul>
            @endif
        	<div class="tab-content" id="myTabContent">
            	<div class="tab-pane show active mb-1" id="general">
                	@if($data->id)
                        {!! Form::open(['route' => ['coreswitch.update', $data->id]]) !!}
                        {{ Form::hidden('_method', 'PUT') }}
                    @else
                        {!! Form::open(['route' => 'coreswitch.store']) !!}
                    @endif
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
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

                        @if(!$data->id)
                        <div class="form-row">                            
                            <div class="form-group col-md-4">
                                {{ Form::label('number_of_port', 'Number of Port') }}
                                <input id="number_of_port" type="number" class="form-control" name="number_of_port" value="" placeholder="number of port" min=1 required>
                                <small class="form-text text-muted">generate port record</small>
                            </div>
                        </div>
                        @endif                     
        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                                <a href="/coreswitch" class="btn btn-secondary">Back</a>
                            </div>
                        </div>            
                    {!! Form::close() !!}
            	</div>
            	<div class="tab-pane" id="port">                    
                	<table class="table table-striped table-bordered table-hover">
                		<thead>
                            <tr>
                                <th>Port Number</th>
                                <th>IP Address</th>                                
                                <th>Action</th>
                            </tr>
                            @csrf
                        </thead>
                        <tbody>                            
                            @foreach($data->ports as $port)
                            <tr>
                                <td>{{ $port->port_number }}</td>
                                <td>{{ $port->ip_address }}</td>
                                <td><div><a href="/coreswitch/{{ $port->id }}/edit" class="btn btn-sm btn-primary mr-1">Edit</a><button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $port->id }});">Delete</button></div></td>
                            </tr>
                        	@endforeach                   
                        </tbody>
                	</table>
            	</div>
			</div>
		</div>
	</div>
@endsection
