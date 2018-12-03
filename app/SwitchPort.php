<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SwitchPort extends Model
{
    protected $fillable = [
        'switch_id', 'vlan_id', 'switch_mode_id', 'port_number'
    ];
    
    public function network_switch() {
        return $this->hasOne(NetworkSwitch::class, 'id', 'switch_id');
    }
    
    public function vlans() {
        return $this->hasMany(SwitchPortVlan::class)->leftJoin('virtual_lans', 'switch_port_vlans.vlan_id', '=', 'virtual_lans.id');
    }
    
    public function port_mode() {
        return $this->hasOne(SwitchMode::class, 'id', 'switch_mode_id');
    }
    
    public function connected_device_type() {
        return $this->hasOne(NetworkDeviceType::class, 'id', 'connected_device_type_id');
    }
    
    public function connected_device() {
        if ($this->connected_device_type_id == 8) {
            return $this->hasOne(EndDevice::class, 'id', 'connected_device_id');
        } else {
            return $this->hasOne(NetworkDevice::class, 'id', 'connected_device_id');
        }
    }
    
    public function ip_table() {
        return $this->hasOne(IpTable::class, 'switch_port_id', 'id');
    }
}
