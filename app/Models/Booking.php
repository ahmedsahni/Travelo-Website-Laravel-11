<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Booking extends Model
{
    use HasFactory;

     // Define the relationship with the User model
     public function user()
     {
         return $this->belongsTo(User::class);
     }

    // Set the table name if different from the default
    protected $table = 'bookings';  // Ensure it matches your actual table name in the database

    // Define the fillable attributes
    use HasFactory;

    protected $fillable = [
        'email',
        'job_name',
        'request_type',  // Add request_type
        'date',       // Make sure to add job_date as fillable
        'city',
        'user_id',        // Assuming you have user_id in the table to associate bookings with users
    ];

    // Specify which attributes should be cast to native types
    protected $casts = [
        'date' => 'datetime', // Cast date to a datetime object
    ];

    // If you need to customize the timestamps (created_at, updated_at)
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // If you don't want the model to manage timestamps (if not using created_at and updated_at)
    // public $timestamps = false;
}
