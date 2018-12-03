<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'network_device_id', 'name', 'cpu', 'cpu_core', 'hdd', 'hdd_capacity', 'ram', 'ram_capacity', 'os'
    ];

    public function virtualserver() {
        return $this->hasMany(VirtualServer::class);
    }

    public function network_device() {
        return $this->hasOne(NetworkDevice::class, 'id', 'network_device_id');
    }
}
