<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'national_code',
        'birth_date',
        'wallet_balance',
        'passport_number',
        'passport_expire_date',
        'phone',
        'mobile',
    ];
}
