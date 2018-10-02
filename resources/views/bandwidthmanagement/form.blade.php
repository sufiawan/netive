@extends('layouts.app')

@section('content')
    <div class="pb-2 mb-2"><h2>Bandwidth Management</h2></div>
    <div class="card">
        <div class="card-body">
            @if($data->id)
                {!! Form::open(['route' => ['bandwidthmanagement.update', $data->id]]) !!}
                {{ Form::hidden('_method', 'PUT') }}
            @else
                {!! Form::open(['route' => 'bandwidthmanagement.store']) !!}
            @endif
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        {{ Form::label('brand', 'Brand') }}
                        <input id="brand" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="brand" value="{{ old('brand', $data->brand) }}" placeholder="brand" required>
                        @if ($errors->has('string'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('string') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('type', 'Type') }}
                        <input id="type" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="type" value="{{ old('type', $data->type) }}" placeholder="type" required>
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
                        <input id="bmn_number" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="bmn_number" value="{{ old('bmn_number', $data->bmn_number) }}" placeholder="bmn number">
                    </div>
                    <div class="form-group col-md-2">
                        {{ Form::label('purchase_year', 'Purchase Year') }}
                        <input id="purchase_year" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="purchase_year" value="{{ old('purchase_year', $data->purchase_year) }}" placeholder="purchase year" required>
                        @if ($errors->has('year'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('year') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('ip_address', 'IP Address') }}
                        <input id="ip_address" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="ip_address" value="{{ old('ip_address', $data->ip_address) }}" placeholder="ip address">
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
                        <input id="device_username" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="device_username" value="{{ old('device_username', $data->device_username) }}"  placeholder="device username" required>
                        @if ($errors->has('string'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('string') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('device_password', 'Device Password') }}
                        <input id="device_password" type="text" class="form-control{{ $errors->has('string') ? ' is-invalid' : '' }}" name="device_password" value="{{ old('device_password', $data->device_password) }}" placeholder="device password" required>
                        @if ($errors->has('string'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('string') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                        <a href="/data" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </form>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
