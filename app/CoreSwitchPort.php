<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class CoreSwitchPort extends Model
{
    public function coreswitch()
    {
        return $this->hasMany(CoreSwitch::class);
    }
}
