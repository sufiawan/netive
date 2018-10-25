<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class UnmanageableSwitchPort extends Model
{
    protected $fillable = [
        'unmanageable_switch_id', 'port_number', 'ip_address'
    ];
}
