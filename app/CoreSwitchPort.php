<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class CoreSwitchPort extends Model
{
    protected $fillable = [
        'core_switch_id', 'port_number', 'ip_address'
    ];
}
