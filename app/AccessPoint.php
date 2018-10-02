<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class AccessPoint extends Model
{
    public $primaryKey = 'id';

    protected $fillable = [
        'brand', 'type', 'bmn_number', 'purchase_year', 'ip_address', 'device_username',
        'device_password', 'wifi_ssid', 'wifi_password', 'location',
    ];
}
