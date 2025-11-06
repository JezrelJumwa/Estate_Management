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
        Schema::create('system_rights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_role_id')->constrained('system_roles')->onDelete('cascade');
            $table->string('menu_name', 100);
            $table->string('page', 100);
            $table->timestamps();
        });

        // Insert default rights for Administrator
        DB::table('system_rights')->insert([
            ['system_role_id' => 1, 'menu_name' => 'REGISTER USER', 'page' => 'users.create', 'created_at' => now(), 'updated_at' => now()],
            ['system_role_id' => 1, 'menu_name' => 'USER LIST', 'page' => 'users.index', 'created_at' => now(), 'updated_at' => now()],
            ['system_role_id' => 1, 'menu_name' => 'REGISTER HOUSE', 'page' => 'houses.create', 'created_at' => now(), 'updated_at' => now()],
            ['system_role_id' => 1, 'menu_name' => 'LIST HOUSES', 'page' => 'houses.index', 'created_at' => now(), 'updated_at' => now()],
            ['system_role_id' => 1, 'menu_name' => 'REGISTER ESTATE', 'page' => 'estates.create', 'created_at' => now(), 'updated_at' => now()],
            ['system_role_id' => 1, 'menu_name' => 'LIST ESTATE', 'page' => 'estates.index', 'created_at' => now(), 'updated_at' => now()],
            // Landlord rights
            ['system_role_id' => 2, 'menu_name' => 'REGISTER HOUSE', 'page' => 'houses.create', 'created_at' => now(), 'updated_at' => now()],
            ['system_role_id' => 2, 'menu_name' => 'LIST HOUSES', 'page' => 'houses.index', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_rights');
    }
};
