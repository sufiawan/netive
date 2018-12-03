<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('brand_type', 'Brand & Type') }}
        <input id="brand_type" type="text" class="form-control{{ $errors->has('brand_type') ? ' is-invalid' : '' }}" name="brand_type" value="{{ old('brand_type', $netdev->brand_type) }}" placeholder="brand & type" required>
        @if ($errors->has('brand_type'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('brand_type') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('bmn_number', 'BMN Number') }}
        <input id="bmn_number" type="text" class="form-control" name="bmn_number" value="{{ old('bmn_number', $netdev->bmn_number) }}" placeholder="bmn number">
    </div>
    <div class="form-group col-md-2">
        {{ Form::label('purchase_year', 'Purchase Year') }}
        <input id="purchase_year" type="number" class="form-control{{ $errors->has('purchase_year') ? ' is-invalid' : '' }}" name="purchase_year" value="{{ old('purchase_year', $netdev->purchase_year) }}" placeholder="purchase year" required>
        @if ($errors->has('purchase_year'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('purchase_year') }}</strong>
            </span>
        @endif
    </div>
<!--    <div class="form-group col-md-6">
        {{ Form::label('ip_address', 'IP Address') }}
        <input id="ip_address" type="text" class="form-control{{ $errors->has('ip_address') ? ' is-invalid' : '' }}" name="ip_address" value="{{ old('ip_address', $netdev->ip_address) }}" placeholder="ip address" pattern="\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}">
        @if ($errors->has('ip_address'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('ip_address') }}</strong>
            </span>
        @endif
    </div>-->
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('device_username', 'Device Username') }}
        <input id="device_username" type="text" class="form-control{{ $errors->has('device_username') ? ' is-invalid' : '' }}" name="device_username" value="{{ old('device_username', $netdev->device_username) }}"  placeholder="device username" required>
        @if ($errors->has('device_username'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('device_username') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('device_password', 'Device Password') }}
        <input id="device_password" type="text" class="form-control{{ $errors->has('device_password') ? ' is-invalid' : '' }}" name="device_password" value="{{ old('device_password', $netdev->device_password) }}" placeholder="device password" required>
        @if ($errors->has('device_password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('device_password') }}</strong>
            </span>
        @endif
    </div>
</div>