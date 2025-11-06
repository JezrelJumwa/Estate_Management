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
        Schema::create('system_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
        });

        // Insert default roles
        DB::table('system_roles')->insert([
            ['name' => 'ADMINISTRATOR', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'LANDLORD', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TENANT', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_roles');
    }
};
