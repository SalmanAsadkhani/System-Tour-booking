<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'location',
        'slug',
        'price',
        'start_date',
        'end_date',
        'description',
        'capacity',
        'image_url',
    ];
}
