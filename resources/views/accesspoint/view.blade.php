@extends('layouts.app')

@section('content')
<div class="pb-2 mb-2"><h2>Access Point</h2></div>
<div class="card">
    <div class="card-body">    
        <div class="form">
            @include('inc.deviceview')

            <div class="form-row">
                <div class="form-group col-md-6">
                    {{ Form::label('wifi_ssid', 'SSID') }}
                    <input id="wifi_ssid" type="text" class="form-control" name="wifi_ssid" value="{{ $data->wifi_ssid }}" readonly>
                </div>
                <div class="form-group col-md-6">
                    {{ Form::label('wifi_password', 'Wifi Password') }}
                    <input id="wifi_password" type="text" class="form-control" name="wifi_password" value="{{ $data->wifi_password }}" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    {{ Form::label('location', 'Location') }}
                    <input id="location" type="text" class="form-control" name="location" value="{{ $data->location }}" readonly>
                </div>
            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">                    
                    <a href="/accesspoint" class="btn btn-secondary">Back</a>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection
