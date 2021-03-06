<?php

namespace NetIve;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nip', 'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
    * @param string|array $roles
    */

    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) || abort(403, 'This action is unauthorized.');
        }
        return $this->hasRole($roles) || abort(403, 'This action is unauthorized.');
    }

    /**
    * Check multiple roles
    * @param array $roles
    */

    public function hasAnyRole($roles)
    {
        return null !== $this->role()->whereIn('name', $roles)->first();
    }

    /**
    * Check one role
    * @param string $role
    */

    public function hasRole($role)
    {
        return null !== $this->role()->where('name', $role)->first();
    }
}
