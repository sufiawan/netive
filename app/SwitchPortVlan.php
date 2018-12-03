<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class SwitchPortVlan extends Model
{
    protected $fillable = [
        'switch_port_id', 'vlan_id'
    ];
    
    public function vlan() {
        return $this->hasOne(VirtualLan::class);
    }
}
