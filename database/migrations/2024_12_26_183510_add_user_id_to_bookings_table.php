<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_add_user_id_to_bookings_table.php

    public function up()
    {
        // Ensure the user_id column exists, if not, add it
        Schema::table('bookings', function (Blueprint $table) {
            // If the column does not exist, add it
            if (!Schema::hasColumn('bookings', 'user_id')) {
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
            }
        });
    }


public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
}

};
