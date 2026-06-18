<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::query()->updateOrCreate(
            ['email' => 'admin@pawmedic.app'],
            [
                'name' => 'Admin PawMedic',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        $this->call(BiodataTrendSeeder::class);

        // Optional: Create test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
