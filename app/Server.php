<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'brand', 'type', 'bmn_number', 'purchase_year', 'ip_address', 'device_username', 'device_password',
        'processor', 'hdd', 'ram', 'os'
    ];
}
