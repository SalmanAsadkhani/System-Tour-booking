<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
    protected $fillable = [ 'title_en', 'title_fa', 'group', 'status'];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}

