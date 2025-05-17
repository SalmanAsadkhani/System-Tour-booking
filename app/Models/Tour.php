<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'price_per_person',
        'currency',
        'capacity',
        'duration_days',
        'duration_nights',
        'departure_location',
        'transportation_type',
        'hotel_info',
        'food_count',
        'difficulty_level',
        'image',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'food_count' => 'integer',
        'difficulty_level' => 'integer',
    ];
}
