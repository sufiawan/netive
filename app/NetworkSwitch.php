<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class NetworkSwitch extends Model
{
    protected $fillable = [
        'network_device_id', 'switch_type_id', 'location'
    ];
    
    public function network_device() {
        return $this->hasOne(NetworkDevice::class, 'id', 'network_device_id');
    }
    
    public function ports() {
        return $this->hasMany(SwitchPort::class, 'switch_id');
    }
    
    public function switch_type() {
        return $this->hasOne(SwitchTypes::class, 'id', 'switch_type_id');
    }
}
