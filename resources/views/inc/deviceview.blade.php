<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('brand_type', 'Brand & Type') }}
        <input id="brand_type" type="text" class="form-control" name="brand_type" value="{{ $netdev->brand_type }}" readonly>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('bmn_number', 'BMN Number') }}
        <input id="bmn_number" type="text" class="form-control" name="bmn_number" value="{{ $netdev->bmn_number }}" readonly>
    </div>
    <div class="form-group col-md-2">
        {{ Form::label('purchase_year', 'Purchase Year') }}
        <input id="purchase_year" type="number" class="form-control" name="purchase_year" value="{{ $netdev->purchase_year }}" readonly>
        
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('device_username', 'Device Username') }}
        <input id="device_username" type="text" class="form-control" name="device_username" value="{{ $netdev->device_username }}" readonly>        
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('device_password', 'Device Password') }}
        <input id="device_password" type="text" class="form-control" name="device_password" value="{{ $netdev->device_password }}" readonly>       
    </div>
</div>
