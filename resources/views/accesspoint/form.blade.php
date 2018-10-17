@extends('layouts.app')

@section('content')
    <div class="pb-2 mb-2"><h2>Access Point</h2></div>
    <div class="card">
        <div class="card-body">
            @if($accesspoint->id)
                {!! Form::open(['route' => ['accesspoint.update', $accesspoint->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
            @else
                {!! Form::open(['route' => 'accesspoint.store']) !!}
            @endif
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        {{ Form::label('brand_type', 'Brand & Type') }}
                        <input id="brand_type" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="brand_type" value="{{ old('brand_type', $accesspoint->brand_type) }}" placeholder="brand & type" required>
                        @if ($errors->has('string'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('string') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        {{ Form::label('bmn_number', 'BMN Number') }}
                        <input id="bmn_number" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="bmn_number" value="{{ old('bmn_number', $accesspoint->bmn_number) }}" placeholder="bmn number">
                    </div>
                    <div class="form-group col-md-2">
                        {{ Form::label('purchase_year', 'Purchase Year') }}
                        <input id="purchase_year" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="purchase_year" value="{{ old('purchase_year', $accesspoint->purchase_year) }}" placeholder="purchase year" required>
                        @if ($errors->has('year'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('ip_address', 'IP Address') }}
                        <input id="ip_address" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="ip_address" value="{{ old('ip_address', $accesspoint->ip_address) }}" placeholder="ip address" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}">
                        @if ($errors->has('ipaddress'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ipaddress') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('device_username', 'Device Username') }}
                        <input id="device_username" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="device_username" value="{{ old('device_username', $accesspoint->device_username) }}"  placeholder="device username" required>
                        @if ($errors->has('string'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('string') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('device_password', 'Device Password') }}
                        <input id="device_password" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="device_password" value="{{ old('device_password', $accesspoint->device_password) }}" placeholder="device password" required>
                        @if ($errors->has('string'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('string') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('wifi_ssid', 'SSID') }}
                        <input id="wifi_ssid" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="wifi_ssid" value="{{ old('wifi_ssid', $accesspoint->wifi_ssid) }}" placeholder="ssid">
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('wifi_password', 'Wifi Password') }}
                        <input id="wifi_password" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="wifi_password" value="{{ old('wifi_password', $accesspoint->wifi_password) }}" placeholder="wifi password">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        {{ Form::label('location', 'Location') }}
                        <input id="location" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="location" value="{{ old('location', $accesspoint->location) }}" placeholder="location">
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
            </form>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
