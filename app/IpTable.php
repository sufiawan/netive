<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class IpTable extends Model
{
    protected $fillable = [
        'ip_table_type_id', 'switch_port_id', 'vlan_id', 'ip_address'
    ];
    
    public function linked_device() {
//        if ($this->ip_table_type_id == 1) {
            return $this->hasOne(SwitchPort::class, 'id', 'switch_port_id');
//        }
    }
}
