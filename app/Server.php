<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'brand_type', 'bmn_number', 'purchase_year', 'ip_address', 'device_username', 'device_password',
        'name', 'cpu', 'cpu_core', 'hdd', 'hdd_capacity', 'ram', 'ram_capacity', 'os'
    ];
    
    public function virtualserver()
    {
        return $this->hasMany(VirtualServer::class);
    }
}
