<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class UnmanageableSwitch extends Model
{
    protected $fillable = [
        'brand_type', 'bmn_number', 'purchase_year', 'ip_address', 'device_username', 'device_password',
        'location'
    ];
    
    public function ports()
    {
        return $this->hasMany(UnmanageableSwitchPort::class, 'unmanageable_switch_id');
    }
}
