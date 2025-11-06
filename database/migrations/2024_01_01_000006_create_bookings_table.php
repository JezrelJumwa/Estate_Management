<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('status', 100);
            $table->timestamps();
        });

        // Insert default booking statuses
        DB::table('bookings')->insert([
            ['status' => 'AVAILABLE', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'UNAVAILABLE', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
