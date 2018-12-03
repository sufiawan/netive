@extends('layouts.app')

@section('content')
    <div class="pb-2 mb-2"><h2>Virtual Server</h2></div>
    <div class="card">
        <div class="card-body">
            @if($data->id)
                {!! Form::open(['route' => ['virtualserver.update', $data->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
            @else
                {!! Form::open(['route' => 'virtualserver.store']) !!}                
            @endif
                {{ Form::hidden('server_id', $data->server_id) }}
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
                    <div class="form-group col-md-2">
                        {{ Form::label('hdd', 'HDD Capacity') }}
                        <div class="input-group mb-3">                
                            <input id="hdd" type="number" class="form-control{{ $errors->has('hdd') ? ' is-invalid' : '' }}" name="hdd" value="{{ old('hdd', $data->hdd) }}"  placeholder="capacity" required>    					
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">GB</span>
                            </div>
                        </div>					
                        <small class="form-text text-muted">(decimal) 1 TB = 1000 GB</small>
                        @if ($errors->has('hdd'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('hdd') }}</strong>
                        </span>
                        @endif           
                    </div>                       
                    <div class="form-group col-md-2">
                        {{ Form::label('ram', 'RAM Capacity') }}
                        <div class="input-group mb-3">                
                            <input id="ram" type="number" class="form-control{{ $errors->has('ram') ? ' is-invalid' : '' }}" name="ram" value="{{ old('ram', $data->ram) }}"  placeholder="capacity" required>    					
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">GB</span>
                            </div>
                        </div>					
                        @if ($errors->has('ram'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ram') }}</strong>
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
                        <a href="/server/{{ $data->server_id }}/edit" class="btn btn-secondary">Back</a>
                    </div>
                </div>            
            {!! Form::close() !!}
        </div>
    </div>
@endsection
