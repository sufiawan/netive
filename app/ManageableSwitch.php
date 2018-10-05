<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class ManageableSwitch extends Model
{
    protected $fillable = [
        'brand_type', 'bmn_number', 'purchase_year', 'ip_address', 'device_username', 'device_password',
        'location'
    ];
}
