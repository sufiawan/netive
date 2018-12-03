<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class VirtualServer extends Model
{
    protected $fillable = [
        'server_id', 'name', 'cpu_core', 'ram', 'hdd', 'os'
    ];
}
