<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'number',
        'gender',
        'role',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function bookings()
{
    return $this->hasMany(Booking::class); // Adjust the relationship based on your actual schema
}
}
