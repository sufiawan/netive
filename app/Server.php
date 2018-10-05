<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'brand_type', 'bmn_number', 'purchase_year', 'ip_address', 'device_username', 'device_password',
        'name', 'cpu', 'cpu_core', 'hdd', 'hdd_capacity', 'hdd_capacity_opt', 'ram', 'ram_capacity', 'ram_capacity_opt', 'os'
    ];
}
