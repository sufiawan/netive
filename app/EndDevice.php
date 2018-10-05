<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class EndDevice extends Model
{
    protected $fillable = [
        'name', 'ip_address', 'description'
    ];
}
