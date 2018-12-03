<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class NetworkDevice extends Model
{
    protected $fillable = [
        'network_device_type_id', 'brand_type', 'bmn_number', 'purchase_year', 'ip_address', 'device_username', 'device_password'
    ];
    
    public function access_point() {
        return $this->hasOne(AccessPoint::class);
    }
    
    public function server() {
        return $this->hasOne(Server::class);
    }
    
    public function network_switch() {
        return $this->hasOne(NetworkSwitch::class);
    }
}
