<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class VirtualLAN extends Model
{
    protected $fillable = [
        'name', 'ip_segment', 'description'
    ];
}
