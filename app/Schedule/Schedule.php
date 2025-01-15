<?php

namespace App\Schedule;

use App\Console\Commands\CleanUpBookings;

class Schedule
{
    public function define($schedule)
    {
        // Schedule the CleanUpBookings command to run daily
        $schedule->command('app:clean-up-bookings')->daily();
    }
}
