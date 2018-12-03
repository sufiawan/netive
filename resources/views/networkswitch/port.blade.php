@if ($has_uplink)
<table id="tbldata" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Port Number</th>
            <th>Mode</th>
            <th>VLAN</th>            
            <th>Connected Device</th>
            <th>IP Address</th>
            <th>Action</th>
        </tr>
        @csrf
    </thead>
    <tbody>                            
        @foreach($data->ports as $port)
        <tr>
            <td>{{ $port->port_number }}</td>
            <td>{{ (!is_null($port->port_mode)) ? $port->port_mode->name : '' }}</td>            
            <td>@if(!is_null($port->vlans) && $port->vlans->count() == 1)
                    {{ $port->vlans{0}->name }}
                @elseif(!is_null($port->vlans) && $port->vlans->count() > 1)
                {{ $port->vlans->count() }} VLANs <button type="button" class="btn btn-secondary btn-sm" onclick="viewVLANs({{ $port->vlans }})">View</button>
                @endif
            </td>
            <td>                
                {{ (!is_null($port->connected_device_type)) ? $port->connected_device_type->name : '' }}
                @if (!is_null($port->connected_device))
                    @if($port->connected_device_type->id == 8)
                        {{ ' | '.$port->connected_device->name }}
                    @else
                        {{ ' | '.$port->connected_device->brand_type }}
                    @endif
                @endif
            </td>
            <td>{{ (!is_null($port->ip_table)) ? $port->ip_table->ip_address : '' }}</td>
            <td>                
                @if ($port->is_uplink)
                    <button type="button" class="btn btn-sm btn-success">UPLINK</button>
                @else
                    @if($port->vlans->count() == 0 && is_null($port->connected_device_type_id) && is_null($port->connected_device_id))
                        <button type="button" class="btn btn-sm btn-primary" onclick="setPort({{ $port->id }});">Set Port</button>
                    @elseif(!is_null($port->port_mode) && $port->vlans->count() > 0 && is_null($port->connected_device_type_id) && is_null($port->connected_device_id))
                        <button type="button" class="btn btn-sm btn-info" onclick="setDevice({{ $port->id }}, {{ $port->port_mode->id }}, {{ $port->vlans }});">Set Device</button>
                    @elseif($port->connected_device_type_id != 7)
                        <button type="button" class="btn btn-sm btn-warning" onclick="unsetDevice({{ $port->id }})">Unset Device</button>                    
                    @endif
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
Please Set Uplink!
@endif

<div class="modal fade" id="modalSetPort" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Switch Port SET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formSetPort">
                    @csrf
                    <input type="hidden" id="switch_port_id_setport" name="switch_port_id_setport" value="">                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{ Form::label('switch_mode_id', 'Port Mode') }}
                            <select id="switch_mode_id" name="switch_mode_id" class="form-control" onchange="switchModeChange(this.value)">                    
                                @foreach($switchmodes as $switchmode)
                                <option value="{{ $switchmode->id }}">{{ $switchmode->name }}</option>
                                @endforeach                    
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{ Form::label('vlan', 'Port VLAN') }} <label id="selectCount"></label>
                            @if(!is_null($vlans))
                            <select id="vlan" name="vlan[]" class="form-control" onchange="vlanChange()">
                                @foreach($vlans as $vlan)
                                <option value="{{ $vlan->id }}">{{ $vlan->name." [".$vlan->ip_segment."]" }}</option>
                                @endforeach
                            </select>
                            @else
                            <div class="col-sm-12">
                                <input type="text" readonly class="form-control-plaintext" value="No Uplink!">
                            </div>
                            @endif
                        </div>
                    </div>                                       
                </form>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="SetPortSubmit()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSetDevice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Switch Device SET</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formSetDevice">
                    @csrf 
                    <input type="hidden" id="switch_port_id_setdevice" name="switch_port_id_setdevice" value="">
                    <input type="hidden" id="vlan_port" name="vlan_port" value="">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{ Form::label('network_device_type', 'Connected Device Type') }}
                            <select id="network_device_type" name="network_device_type" class="form-control" onchange="networkDeviceTypeChange(this.value)">                    
                                @foreach($ndtypes as $ndtype)
                                <option value="{{ $ndtype->id }}">{{ $ndtype->name }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            {{ Form::label('network_device', 'Connected Device') }}
                            <select id="network_device" name="network_device" class="form-control" onchange="connectedDeviceChange(this.value)">
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row" id="selectConnectedSwitchPort" style="display: none;">
                        <div class="form-group col-md-12">
                            {{ Form::label('connected_switch_port', 'Connected Switch Port (Uplink)') }}
                            <select id="connected_switch_port" name="connected_switch_port" class="form-control">
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row" id="selectIPAddress" style="display: none;">
                        <div class="form-group col-md-12">
                            {{ Form::label('ip_address', 'IP Address') }}
                            <select id="ip_address" name="ip_address" class="form-control">
                            </select>
                        </div>
                    </div>
                </form>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="SetDeviceSubmit()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalViewVLANs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View VLANs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">                    
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function switchModeChange(portMode) {        
        $('#vlan').prop('multiple', (portMode == 2));               
    }
    
    function networkDeviceTypeChange(typeid) {
        $.ajax({
            url:'/networkdevice/show/'+typeid,
            type:'GET',
            dataType: 'json',
            success: function( json ) {
                $('#network_device').find('option').remove()                                               
                $.each(json, function(i, value) {
                    switch(typeid) {
//                        case '1':
//                            $('#network_device').append($('<option>').text(value.brand_type + ' - ' + value.bmn_number + ' (' + value.purchase_year + ') | ' + value.access_point.location).attr('value', value.id));
//                            break;
//                        case '6':
//                            $('#network_device').append($('<option>').text(value.server.name + ' | ' + value.brand_type + ' - ' + value.bmn_number + ' (' + value.purchase_year + ')').attr('value', value.id));
//                            break;
//                        case '7':
//                            $('#network_device').append($('<option>').text(value.brand_type + ' - ' + value.bmn_number + ' (' + value.purchase_year + ') | ' + value.network_switch.switch_type.name).attr('value', value.id));
//                            break;
                        case '8':
                            $('#network_device').append($('<option>').text(value.name).attr('value', value.id));
                            break;
                        default:
                            $('#network_device').append($('<option>').text(value.brand_type + ' - ' + value.bmn_number + ' (' + value.purchase_year + ')').attr('value', value.id));
                            break;
                    }                                 
                });
                
                connectedDeviceChange($('#network_device').val());
            }
        });               
    }
    
    function vlanChange() {
        var vlans = $('#vlan option:selected');
        
        if (vlans.length > 1)
            $('#selectCount').text('(' + vlans.length + ' selected)');
        else
            $('#selectCount').text('');
    }
    
    function connectedDeviceChange(switchid) {
        var typeid = $('#network_device_type').val();
        
        $('#connected_switch_port').find('option').remove();
        $('#ip_address').find('option').remove();
        
        if (typeid == 7) {                        
            $.ajax({
                url:'/networkswitch/showport/'+switchid,
                type:'GET',            
                dataType: 'json',
                success: function( json ) {                                                                  
                    $.each(json, function(i, value) {                        
                        $('#connected_switch_port').append($('<option>').text('Port '+value.port_number).attr('value', value.id));                        
                    });
                }
            });
            
            $('#selectConnectedSwitchPort').show();
            $('#selectIPAddress').hide();
        } else {            
            $.ajax({
                url:'/networkswitch/showip/'+$('#vlan_port').val(),
                type:'GET',            
                dataType: 'json',
                success: function( json ) {                    
                    $.each(json, function(i, value) {                        
                        $('#ip_address').append($('<option>').text(value.ip_address).attr('value', value.ip_address));                        
                    });
                }
            });
            
            $('#selectConnectedSwitchPort').hide();
            $('#selectIPAddress').show();
        }
    }    
    
    function SetPortSubmit() {        
        $.ajax({
            url: '/networkswitch/setport',
            method: 'POST',            
            data: $('#formSetPort').serialize(),
            success: function(data) {                
                bootbox.alert(data.message, function(){
                    if(data.status) {
                        location.reload();
                    }
                })                                
            }
        });
    }
    
    function setPort(id) {
        $('#switch_port_id_setport').val(id);
        switchModeChange($('#switch_mode_id').val());
        $('#modalSetPort').modal('show');
    }
    
    function setDevice(portid, modeid, vlanid) {
        $('#vlan_port').val(vlanid[0].id);
        
        if (modeid == 2)
            $('#network_device_type').val(7);
        
        $('#network_device_type').prop('disabled', (modeid == 2));
        networkDeviceTypeChange($('#network_device_type').val());                
            
        $('#switch_port_id_setdevice').val(portid);
        $('#modalSetDevice').modal('show');
    }
    
    function SetDeviceSubmit() {                
        var xxx = $('#formSetDevice').serialize();
        debugger;
        $.ajax({
            url: '/networkswitch/setdevice',
            method: 'POST',            
            data: $('#formSetDevice').serialize(),
            success: function(data) {                
                bootbox.alert(data.message, function(){
                    if(data.status) {
                        location.reload();
                    }
                })                                
            }
        });
    }
    
    function viewVLANs(vlan) {
        $('.list-group').find('li').remove();
        $.each(vlan, function(i, value) {                        
            $('.list-group').append($('<li class="list-group-item">').text(value.name));
        });
        
        $('#modalViewVLANs').modal('show');
    }
    
    function unsetDevice(portid) {
        bootbox.confirm("Are you sure want to unset this device?", function(result) {
            if (result) {
                $.ajax({
                    url: '/networkswitch/unsetdevice',
                    method: 'POST',            
                    data: {
                        _token: '{{ csrf_token() }}',
                        switch_port_id_unsetdevice: portid
                    },
                    success: function(data) {                
                        bootbox.alert(data.message, function(){
                            if(data.status) {
                                location.reload();
                            }
                        })                                
                    }
                });
            }
        })
    }

    $(document).ready(function () {
        $('#tbldata').DataTable();        
    });
</script>