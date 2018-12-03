<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class AccessPoint extends Model
{
    protected $fillable = [
        'network_device_id', 'wifi_ssid', 'wifi_password', 'location'
    ];

    public function network_device() {
        return $this->hasOne(NetworkDevice::class, 'id', 'network_device_id');
    }
}
