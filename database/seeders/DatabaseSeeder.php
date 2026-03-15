<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'id_number' => '99999999',
            'first_name' => 'Test',
            'last_name' => 'User',
            'gender' => 'Male',
            'status_id' => 1,
            'system_role_id' => 1,
            'email' => 'test@example.com',
        ]);
    }
}
