<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $fillable = ['title_en', 'title_fa', 'status'];

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function admins() {
        return $this->belongsToMany(Admin::class, 'admin_role');
    }

}

