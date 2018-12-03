@extends('layouts.app')

@section('content')
    <div class="pb-2 mb-2"><h2>Endpoint Device</h2></div>
    <div class="card">
        <div class="card-body">
            @if($data->id)
                {!! Form::open(['route' => ['enddevice.update', $data->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
            @else
                {!! Form::open(['route' => 'enddevice.store']) !!}
            @endif
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('name', 'Name') }}
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $data->name) }}"  placeholder="name" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>           
                    
                    <div class="form-group col-md-6">
                        {{ Form::label('description', 'Description') }}
                        <input id="description" type="text" class="form-control" name="description" value="{{ old('description', $data->description) }}" placeholder="description">                        
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="/enddevice" class="btn btn-secondary">Back</a>
                    </div>
                </div>            
            {!! Form::close() !!}
        </div>
    </div>
@endsection
