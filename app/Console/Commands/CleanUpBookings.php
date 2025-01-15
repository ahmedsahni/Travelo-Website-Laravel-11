<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CleanUpBookings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-up-bookings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes old bookings where the travel date has already passed.';

    /**
     * Execute the console command.
     */
    public function handle()
{
    $this->info('Starting the cleanup process for old bookings...');

    try {
        // Use the 'date' column instead of 'travel_date'
        $deleted = DB::table('bookings')
            ->where('date', '<', Carbon::now())  // Compare with the 'date' column
            ->delete();

        $this->info("$deleted old bookings have been cleaned up.");
        Log::info("CleanUpBookings: $deleted old bookings were deleted successfully.");
    } catch (\Exception $e) {
        $this->error('An error occurred during the cleanup process: ' . $e->getMessage());
        Log::error('CleanUpBookings Error: ' . $e->getMessage());
        Log::error('Stack Trace: ' . $e->getTraceAsString());
    }
}

}
