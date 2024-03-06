<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getCreatedAtAttribute($value): string
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    public function getUpdatedAtAttribute($value): string
    {
        return date('d-m-Y H:i:s', strtotime($value));
    }

    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'user_company', 'user_id', 'company_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function hasPermission(string $permission): bool
    {
        $roles = $this->roles()->get();
        foreach ($roles as $role) {
            $permissions = $role->permissions()->get();
            foreach ($permissions as $perm) {
                if ($perm->permission === $permission) {
                    return true;
                }
            }
        }
        return false;
    }

    public function getPermissionsAttribute(): array
    {
        $roles = $this->roles()->get();
        $permissions = [];
        foreach ($roles as $role) {
            $rolePermissions = $role->permissions()->get();
            foreach ($rolePermissions as $perm) {
                $permissions[] = $perm->name;
            }
        }
        return $permissions;
    }

}
