<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasFactory , HasApiTokens;

    protected $fillable = [
        'name',
        'mobile',
        'password',
        'national_code',
        'birth_date',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_roles');
    }



    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'admin_permissions');
    }



    public function hasRole($roleName)
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    public function hasPermissionTo($permissionName)
    {

        if ($this->permissions()->where('title_en', $permissionName)->exists()) {
            return true;
        }


        foreach ($this->roles as $role) {
            if ($role->permissions()->where('title_en', $permissionName)->exists()) {
                return true;
            }
        }

        return false;
    }

}
