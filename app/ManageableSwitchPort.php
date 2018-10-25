<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class ManageableSwitchPort extends Model
{
    protected $fillable = [
        'manageable_switch_id', 'vlan_id', 'port_number', 'ip_address'
    ];
    
    public function vlan()
    {
        return $this->hasOne(VirtualLAN::class, 'id', 'vlan_id');
    }
}
