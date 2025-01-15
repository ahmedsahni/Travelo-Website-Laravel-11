<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EditBooking extends Model
{
    use HasFactory;

    protected $table = 'bookings'; // Assuming you're editing the same bookings table

    protected $fillable = [
        'user_id',
        'travel_type',
        'date',
        'country_name',
        // Add any other fields that need to be editable
    ];
}
