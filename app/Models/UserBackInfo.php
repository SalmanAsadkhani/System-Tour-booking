<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBackInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_number',
        'account_number',
        'shaba_number',

    ];
}
