<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'tour_id',
      'num_guests',
      'total_price',
      'booking_date'
    ];
}
