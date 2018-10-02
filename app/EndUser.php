<?php

namespace NetIve;

use Illuminate\Database\Eloquent\Model;

class EndUser extends Model
{
    protected $fillable = [
        'name', 'ip_address', 'description'
    ];
}
