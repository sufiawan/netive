@extends('layouts.app')

@section('content')
    <div class="pb-2 mb-2"><h2>Access Point</h2></div>
    <div class="card">
        <div class="card-body">
            @if($data->id)
                {!! Form::open(['route' => ['accesspoint.update', $data->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
            @else
                {!! Form::open(['route' => 'accesspoint.store']) !!}
            @endif
                @csrf
                
                @include('inc.deviceform')

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('wifi_ssid', 'SSID') }}
                        <input id="wifi_ssid" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="wifi_ssid" value="{{ old('wifi_ssid', $data->wifi_ssid) }}" placeholder="ssid">
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('wifi_password', 'Wifi Password') }}
                        <input id="wifi_password" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="wifi_password" value="{{ old('wifi_password', $data->wifi_password) }}" placeholder="wifi password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        {{ Form::label('location', 'Location') }}
                        <input id="location" type="text" class="form-control" name="location" value="{{ old('location', $data->location) }}" placeholder="location">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="/accesspoint" class="btn btn-secondary">Back</a>
                    </div>
                </div>            
            {!! Form::close() !!}
        </div>
    </div>
@endsection
