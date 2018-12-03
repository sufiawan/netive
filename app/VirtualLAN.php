<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class VirtualLan extends Model
{
    protected $fillable = [
        'name', 'ip_segment', 'description'
    ];
    
    public function clients() {
        return $this->hasMany(IpTable::class, 'vlan_id', 'id');
    }
}
